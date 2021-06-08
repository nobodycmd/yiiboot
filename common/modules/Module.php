<?php
namespace common\modules;


use Yii;

class Module extends \yii\base\Module
{
    public function init()
    {
        parent::init();
        $class = new \ReflectionClass($this);
        if (strpos(Yii::$app->id,'front') !== false) {
            $this->controllerNamespace = $class->getNamespaceName() . '\\frontend\\controllers';
            $this->viewPath = $this->basePath . '/frontend/views';
        } elseif (strpos(Yii::$app->id,'backend') !== false) {
            $this->controllerNamespace = $class->getNamespaceName() . '\\backend\\controllers';
            $this->viewPath = $this->basePath . '/backend/views';
        } elseif (strpos(Yii::$app->id , 'console') !== false) {
            $this->controllerNamespace = $class->getNamespaceName() . '\\console\\controllers';
        }
    }
}