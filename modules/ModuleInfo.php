<?php
namespace modules;


use mdm\admin\models\Menu;


class ModuleInfo
{
    public $name = 'module name';

    public function install()
    {
        return true;
    }

    public function uninstall()
    {
        return true;
    }

    /**
     * 在菜单插件管理下添加一个新菜单
     * @param $name
     * @param $route
     * @param int $parent
     * @return bool|Menu
     */
    protected function addMenu($name, $route = null, $parent = 0)
    {
        $model = new Menu();
        $model->name = $name;
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
     * @param $name
     * @param null $parent
     * @return bool
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    protected function deleteMenu($name, $parent = null)
    {
        $menu = Menu::find()->andWhere(['name' => $name])->andFilterWhere(['parent' => $parent])->one();
        if ($menu === null) {
            return true;
        }
        return $menu->delete();
    }
}
