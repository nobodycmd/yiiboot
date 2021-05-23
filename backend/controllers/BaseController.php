<?php
// +----------------------------------------------------------------------
// | When work is a pleasure, life is a joy!
// +----------------------------------------------------------------------
// | User: ShouKun Liu  |  Email:24147287@qq.com  | Time:2016/12/10 23:56
// +----------------------------------------------------------------------
// | TITLE:基础类
// +----------------------------------------------------------------------

namespace backend\controllers;


use yii\db\ActiveRecord;

use yii\web\Controller;



/**
 * Class BaseController
 * @package backend\controllers
 */
class BaseController extends Controller
{

    public $layout = 'main';

    /**
     * @var array
     */
    public $param;


    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        //all param name is lower
        $this->param = array_merge($this->request->get(), $this->request->post());
    }

    public function getParam($name=null){
        if($name===null || !isset($this->param[$name])){
            return $this->param;
        }
        return $this->param[$name];
    }

    /**
     * @param $m ActiveRecord
     */
    public function loadRequestDataIntoActiveModel($m){
        $ary = explode('\\', $m->className() );
        $m->setAttributes($this->param[$ary[count($ary) - 1]], false);
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }



}

