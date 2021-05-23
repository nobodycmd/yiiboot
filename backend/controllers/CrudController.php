<?php
// +----------------------------------------------------------------------
// | When work is a pleasure, life is a joy!
// +----------------------------------------------------------------------
// | User: ShouKun Liu  |  Email:24147287@qq.com  | Time:2016/12/30 23:02
// +----------------------------------------------------------------------
// | TITLE:后台首页
// +----------------------------------------------------------------------

namespace backend\controllers;


use backend\helps\Tree;
use backend\models\AdminRule;
use Yii;
use backend\models\AdminRole;
use backend\models\TestForm;
use Symfony\Component\VarDumper\Tests\Fixture\DumbFoo;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Class IndexController
 * @package backend\controllers
 */
class CrudController extends BaseController
{

    private function getTables()
    {
        $dsn = \Yii::$app->db->dsn;
        $dbName = substr(strrchr($dsn, '='), 1);
        $dbname = str_replace(';', '', $dbName);
        //echo $dbname;exit;
        $aryTables = \Yii::$app->db->createCommand("select table_name,table_comment from information_schema.tables where table_schema='$dbname'")->queryAll();

        return $aryTables;

        foreach ($aryTables as $oneTable) {
            $tableName = $oneTable['table_name'];
            $tableComment = $oneTable['table_comment'];


        }
    }

    public function actionIndex()
    {


        return $this->render('index',['menu'=>$this->menuHtml]);
    }




}