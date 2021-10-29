<?php
namespace modules;

use mdm\admin\models\Menu;
use yii\console\controllers\MigrateController;


abstract class ModuleInstall
{
    public $menuName = false;

    private function getModuleName(){
        $class = get_class($this);

        $aryNames = explode('\\',$class);
        array_pop($aryNames);
        return array_pop($aryNames);
    }

    public abstract function install();

    public abstract function uninstall();

    public function installByPath()
    {
        /**
         * @var $migrate MigrateController
         */
        $migrate = \Yii::createObject([
            'class' => 'common\controllers\MigrateController',
            'migrationPath' => [
                '@modules/'. $this->getModuleName() .'/console/migrations',
            ],
            'db' => \Yii::$app->getDb(),
            'moduleName' => $this->getModuleName(),
        ]);
        return $migrate->actionUp() == 0;
    }


    /**
     * 在菜单插件管理下添加一个新菜单
     * @param $name
     * @param $route
     * @param int $parent
     * @return bool|Menu
     */
    protected function addMenu($route = null, $parent = 0)
    {
        if($this->menuName == false)
            return true;

        $model = new Menu();
        $model->name = $this->menuName;
        $model->route = $route;
        $model->parent = $parent;
        if ($model->save(false)) {
            return $model;
        } else {
            return false;
        }
    }

    /**
     * 删除一个插件管理下的子菜单
     * @param null $parent
     * @return bool
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    protected function deleteMenu($parent = null)
    {
        if($this->menuName == false)
            return true;

        $menu = Menu::find()->andWhere(['name' => $this->menuName])->andFilterWhere(['parent' => $parent])->one();
        if ($menu === null) {
            return true;
        }
        return $menu->delete();
    }
}
