<?php
namespace services;

/**
 * 通过文件锁提供基于操作系统的并发和并行的互斥支持
 * @package app\services
 */
class FileLockService
{
    public static function fileViaName($filename){
        $file = \Yii::getAlias('@common/../filelock/'.$filename);
        return $file;
    }

    /**
     * 获取文件锁后进行代码执行
     * @param $filename
     * @param array $callable
     * @param array $param_arr
     * @return array 返回['locked' =>boolean,'result'=>'callback result']的结果
     */
    public static function fileLockWithCallback($filename,$callable=[],$param_arr =[]){
        $file = self::fileViaName($filename);
        $fp = fopen($file, 'w+');
        $locked = flock($fp, LOCK_EX | LOCK_NB);

        $resultOfCallback = [];
        if($locked && $callable && is_callable($callable)){
            try {
                //如果callable是一个死循环，代码将一直block在这里而没有返回
                $resultOfCallback = call_user_func_array($callable, $param_arr);
            }catch (\Exception $e){
                throw $e;
            }catch (\Throwable $e){
                throw $e;
            } finally {
                //释放锁和删除文件
                flock($fp,LOCK_UN);
                fclose($fp);
                file_exists($file) && unlink($file);
            }
        }


        return [
            'locked' => $locked,
            'result' => $resultOfCallback
        ];
    }

    /**
     * 是否对一个文件可以获得它的锁
     * 如果可以，说明没有进程进行占有，这时进行文件的解锁和删除
     * @param $filename
     * @return bool
     */
    public static function canGetLock($filename){
        $file = self::fileViaName($filename);
        $fp = fopen($file, 'w+');
        $succ = flock($fp, LOCK_EX | LOCK_NB);
        //获得了锁
        if($succ) {
            flock($fp, LOCK_UN);
            fclose($fp);
            file_exists($file) && unlink($file);
        }
        return $succ;
    }


}
