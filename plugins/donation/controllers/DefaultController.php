<?php


namespace plugins\donation\controllers;


use plugins\donation\models\Donation;
use plugins\donation\Plugin;
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