<?php
namespace common\components;


use common\models\Package;
use yii\base\Component;
use yii\helpers\FileHelper;


class PackageManager extends Component
{
    private $allModules = [];
    private $allModulesInfo = [];
    private $allPlugin = [];

    /**
     * @return Package
     */
    public function getModel()
    {
        return Package::findOne([
            'class' => get_class($this),
        ]);
    }


    public function getAllModule(){
        if($this->allModules)return $this->allModules;

        $fileSystem = new \FilesystemIterator(\Yii::getAlias('@common/modules'));
        foreach ($fileSystem as $item) {
            if ($item->isDir()) {
                $path = new \SplFileInfo($item);
                $class = 'commom\\modules\\' . $path->getBasename() . '\\Module';
                $this->allModules[$path->getBasename()] = $class;
            }
        }
        return $this->allModules;
    }


    public function getAllPlugin(){
        if($this->allPlugin)return $this->allPlugin;

        $fileSystem = new \FilesystemIterator(\Yii::getAlias('@plugin'));
        foreach ($fileSystem as $item) {
            if ($item->isDir()) {
                $path = new \SplFileInfo($item);
                $class = 'plugin\\' . $path->getBasename() . '\\Plugin';
                $this->allPlugin[$path->getBasename()] = $class;
            }
        }
        return $this->allPlugin;
    }

    private function getAllModuleInfo(){
        if($this->allModulesInfo)return $this->allModulesInfo;

        $fileSystem = new \FilesystemIterator(\Yii::getAlias('@common/modules'));
        foreach ($fileSystem as $item) {
            if ($item->isDir()) {
                $path = new \SplFileInfo($item);
                $class = 'common\\modules\\' . $path->getBasename() . '\\ModuleInfo';
                $this->allModulesInfo[$path->getBasename()] = $class;
            }
        }
        return $this->allModulesInfo;
    }


    public function install(Package $plugin)
    {
        if($plugin->type == 1){
            $aryModuleInfo = $this->getAllModuleInfo();
            if(isset($aryModuleInfo[$plugin->name]))
            {
                $instance = \Yii::createObject([
                    'class' => $aryModuleInfo[$plugin->name],
                ]);
            }
            else
                return false;
        }else {
            $instance = \Yii::createObject($plugin->class);
        }
        try {
            if ($instance->install($plugin)) {
                $plugin->is_install = 1;
                $plugin->is_open = 1;
                return $plugin->save();
            }
            return false;
        } catch(\Exception $e) {
            return false;
        }
    }

    public function uninstall(Package $plugin)
    {
        if($plugin->type == 1){
            $ary = $this->getAllModuleInfo();
            if(isset($ary[$plugin->name]) == false)
                $instance = \Yii::createObject([
                    'class' => $ary[$plugin->name],
                ]);
            return false;
        }else {
            $instance = \Yii::createObject([
                'class' => $plugin->class
            ]);
        }
        try {
            if ($instance->uninstall()) {
                $plugin->is_install = 0;
                $plugin->is_open = 0;
                return $plugin->save();
            }
            return false;
        } catch(\Exception $e) {
            return false;
        }
    }

    public function open(Package $plugin)
    {
        $plugin->is_open = 1;
        return $plugin->save();
    }

    public function close(Package $plugin)
    {
        $plugin->is_open = 0;
        return $plugin->save();
    }

    public function upgrade()
    {

    }


    public function getPath()
    {
        $class = new \ReflectionClass($this);
        return dirname($class->getFileName());
    }

    public function getNamespace()
    {
        $class = new \ReflectionClass($this);
        return $class->getNamespaceName();
    }

}