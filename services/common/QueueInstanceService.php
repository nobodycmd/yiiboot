<?php
namespace services\common;

use yii\queue\db\Queue;

/*
 * db queue 以dbqueue类名+频道(__CLASS_CHANNEL_NAME)进行区分获得锁以进行序列化查询
 * 对于可以多频道一起跑的任务，可以将这些任务分配到多个频道上
 * 然后针对每个频道可以启动至少一个进程进行队列数据处理
 */
class QueueInstanceService
{
    /**
     * 除去默认频道外，其他的频道的数量
     * @var int
     */
    public static $CHANNEL_COUNT_BUT_DEFAULT = 3;

    private static function getChannelViaNumber($i){
        return 'channel_' . $i;
    }

    /**
     * @return \yii\queue\db\Queue
     */
    public static function getQueue($useMultiChannelForCustomBizNeed = false)
    {
        /**
         * @var $queue Queue
         */
        $queue = \Yii::$app->queue;
        if ($useMultiChannelForCustomBizNeed) {
            $autoID = AutoIDService::getID();
            $i = $autoID % self::$CHANNEL_COUNT_BUT_DEFAULT + 1;
            $channelName = self::getChannelViaNumber($i);
            $queue->channel = $channelName;
        }
        return $queue;
    }

    /**
     * 推送队列到数据库
     * @param $job
     * @param bool $useMultiChannelForCustomBizNeed 默认FALSE
     * @return null|string
     */
    public static function push($job, $useMultiChannelForCustomBizNeed = false){
        $queue = self::getQueue($useMultiChannelForCustomBizNeed);
        return $queue->push($job);
    }

    private static function configTemp($channelName,$numProcess = 1){
        if($channelName == self::getQueue()->channel){
            $command = \Yii::getAlias('@console/../yii queue/listen ');
        }else {
            $command = \Yii::getAlias('@console/../yii queue-task/run ' . $channelName);
        }
        $errlog =  \Yii::getAlias('@console/../supervisorlog/'.$channelName.'.err.log');
        $outlog = \Yii::getAlias('@console/../supervisorlog/'.$channelName.'.log');

        @touch($errlog);
        @touch($outlog);

        $str = <<<EOF
[program:$channelName]
process_name=%(program_name)s_%(process_num)02d
command=$command
autostart=true
autorestart=true
user=root
numprocs=$numProcess
redirect_stderr=true
stderr_logfile=$errlog
stdout_logfile=$outlog
EOF;
        return $str;
    }

    /**
     * 生产所有频道的supervisor进程配置文件
     */
    public static function generateSupervisorConfig($isDefautChannel = true, $numProcess=1, $configDir=''){
        if(!$configDir){
            $configDir = '/etc/supervisord.d/';
        }
        @mkdir($configDir, 0777, true);

        $aryChannel = [];
        if($isDefautChannel) {//默认的频道
            $aryChannel[] = self::getQueue()->channel;
        }else {
            for ($i = 1; $i <= self::$CHANNEL_COUNT_BUT_DEFAULT; $i++) {
                $aryChannel[] = self::getChannelViaNumber($i);
            }
        }
        foreach ($aryChannel as $channelName){
            $file = $configDir . $channelName . '.ini';
            file_put_contents($file, self::configTemp($channelName,$numProcess));
        }
    }




}
