<?php

namespace backend\controllers;


use backend\models\Package;
use common\components\PackageManager;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;


class PackageController extends BaseController
{
    /* @var $manager PackageManager */
    private $manager;

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $this->manager = new PackageManager();
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'open' => ['post'],
                    'close' => ['post'],
                    'install' => ['post'],
                    'uninstall' => ['post']
                ],
            ],
        ];
    }

    public function actionLoad(){
        $manager = new PackageManager();
        foreach ($manager->getAllModule() as $name => $className){
            $package = Package::findOne([
                'name' => $name,
                'class' => $className,
            ]);
            if($package)
                continue;
            $package = new Package();
            $package->name = $name;
            $package->type = 1;
            $package->class = $className;
            $package->is_open = $package->is_install = 0;
            $package->created_at = $package->updated_at = time();
            $package->save();
        }
        foreach ($manager->getAllPlugin() as $name => $className){
            $package = Package::findOne([
                'name' => $name,
                'class' => $className,
            ]);
            if($package)
                continue;
            $package = new Package();
            $package->name = $name;
            $package->type = 2;
            $package->class = $className;
            $package->is_open = $package->is_install = 0;
            $package->created_at = $package->updated_at = time();
            $package->save();
        }
        return $this->redirect('index');
    }

    /**
     * Lists all Module models.
     * @return mixed
     */
    public function actionIndex()
    {

        $dataProvider = new ActiveDataProvider([
            'query' => Package::find()->where([

            ]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    // 安装
    public function actionInstall()
    {
        $id = Yii::$app->request->post('id');
        $module = Package::findOne($id);
        if(!$this->manager->install($module)){
            Yii::$app->session->setFlash('error', '安装失败');
        } else {
            Yii::$app->session->setFlash('success', '安装成功');
        }
        return $this->redirect(['index']);
    }
    //卸载
    public function actionUninstall()
    {
        $id = Yii::$app->request->post('id');
        $module = Package::findOne($id);
        if(!$this->manager->uninstall($module)){
            Yii::$app->session->setFlash('error', '卸载失败');
        } else {
            Yii::$app->session->setFlash('success', '卸载成功');
        }
        return $this->redirect(['index']);
    }

    // 开启
    public function actionOpen()
    {
        $id = Yii::$app->request->post('id');
        $module = Package::findOne($id);
        if(!$module->is_install){
            Yii::$app->session->setFlash('error', '没安装');
        }
        if(!$this->manager->open($module)){
            Yii::$app->session->setFlash('error', '打开失败');
        } else {
            Yii::$app->session->setFlash('success', '打开成功');
        }
        return $this->redirect(['index']);
    }
    // 关闭
    public function actionClose()
    {
        $id = Yii::$app->request->post('id');
        $module = Package::findOne($id);
        if(!$module->is_install){
            Yii::$app->session->setFlash('error', '没安装');
        }
        if(!$this->manager->close($module)){
            Yii::$app->session->setFlash('error', '关闭失败');
        } else {
            Yii::$app->session->setFlash('success', '关闭成功');
        }
        return $this->redirect(['index']);
    }


}
