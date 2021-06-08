<?php


namespace plugin\donation\controllers;


use plugin\donation\models\Donation;
use plugin\donation\Plugin;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $plugins = new Plugin();
        $config = $plugins->getConfig();
        $query = Donation::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        return $this->render('index', [
            'config' => $config,
            'dataProvider' => $dataProvider
        ]);
    }
}