<?php

namespace backend\controllers;

use Yii;
use common\helpers\ResultHelper;

/**
 * 主控制器
 *
 * Class MainController
 * @package backend\controllers
 */
class MainController extends BaseController
{
    /**
     * 系统首页
     *
     * @return string
     */
    public function actionIndex()
    {
        //$this->layout = false;
        return $this->renderPartial($this->action->id, [
        ]);
    }

    /**
     * 子框架默认主页
     *
     * @return string
     */
    public function actionSystem()
    {
        return $this->render($this->action->id, [
            'memberCount' => 0,
            'memberAccount' => 0,
        ]);
    }

    /**
     * 用户指定时间内数量
     *
     * @param $type
     * @return array
     */
    public function actionMemberBetweenCount($type)
    {
        $data = Yii::$app->services->member->getBetweenCountStat($type);

        return ResultHelper::json(200, '获取成功', $data);
    }

    /**
     * 充值统计
     *
     * @param $type
     * @return array
     */
    public function actionMemberRechargeStat($type)
    {
        $data = Yii::$app->services->memberCreditsLog->getRechargeStat($type);

        return ResultHelper::json(200, '获取成功', $data);
    }

    /**
     * 用户指定时间内消费日志
     *
     * @param $type
     * @return array
     */
    public function actionMemberCreditsLogBetweenCount($type)
    {
        $data = Yii::$app->services->memberCreditsLog->getBetweenCountStat($type);

        return ResultHelper::json(200, '获取成功', $data);
    }

    /**
     * 清理缓存
     *
     * @return string
     */
    public function actionClearCache()
    {
        if (Yii::$app->request->getIsPost()) {
            Yii::$app->cache->flush();
            return $this->message('清理成功', $this->refresh());
        }

        return $this->render($this->action->id);
    }
}