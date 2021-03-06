<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ArrayDataProvider */

$allModule = (new \common\components\PackageManager())->getAllModule();
$allPlugin = (new \common\components\PackageManager())->getAllPlugin();

$this->title = '系统扩展包的管理';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="module-index">
    <div class="alert alert-warning">
        卸载包可能会进行删除相关菜单、删除相关数据库表等操作，请确保数据没用或者已经备份的情况下进行，谨慎操作！
    </div>

    <div>
        <?php
        echo Html::a('刷新包',\yii\helpers\Url::to(['load']));
        ?>
    </div>

    <div class="box box-primary">
        <div class="box-body">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'name:text:名字',
                    [
                        'attribute' => 'type',
                        'label' => '类型',
                        'value' => function($model){
                            return $model->type == 1 ? '模块' : '插件';
                        }
                    ],
                    'class:text:类名',
                    [
                        'attribute' => 'is_install',
                        'label' => '安装',
                        'value' => function($model){
                            return $model->is_install == 1 ? '已安装' : '未安装';
                        }
                    ],
                    [
                        'attribute' => 'is_open',
                        'label' => '开关',
                        'value' => function($model){
                            return $model->is_open == 1 ? '已打开' : '关闭中';
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{open} {close} {install} {uninstall} ',
                        'buttons' => [
                            'open' => function($url, $model, $key) {

                                if (!$model->is_install) {
                                    return false;
                                }
                                if ($model->is_open) {
                                    return false;
                                }
                                return Html::a('开启', ['open'], [
                                    'data-method' => 'post',
                                    'data-params' => ['id' => $model->id],
                                    'class' => 'btn btn-default btn-xs'
                                ]);
                            },
                            'close' => function($url, $model, $key) {
                                if (!$model->is_install) {
                                    return false;
                                }
                                if (!$model->is_open) {
                                    return false;
                                }
                                return Html::a('关闭', ['close'], [
                                    'data-method' => 'post',
                                    'data-params' => ['id' => $model->id],
                                    'class' => 'btn btn-default btn-xs'
                                ]);
                            },
                            'install' => function($url, $model, $key) {
                                if ($model->is_install) {
                                    return false;
                                }
                                return Html::a('安装', ['install'], [
                                    'data-method' => 'post',
                                    'data-params' => ['id' => $model->id],
                                    'class' => 'btn btn-default btn-xs'
                                ]);
                            },
                            'uninstall' => function($url, $model, $key) {
                                if (!$model->is_install) {
                                    return false;
                                }
                                return Html::a('卸载', ['uninstall'], [
                                    'data-method' => 'post',
                                    'data-confirm' => '确定要卸载该模块吗?',
                                    'data-params' => ['id' => $model->id],
                                    'class' => 'btn btn-default btn-xs'
                                ]);
                            },

                        ]
                    ],
                ],
            ]); ?>
        </div>
    </div>

</div>
