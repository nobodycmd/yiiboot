<?php
namespace common\components;

use common\models\Package;
use yii\base\Component;

class PackageManager extends Component
{
    private $allModules = [];
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

        $fileSystem = new \FilesystemIterator(\Yii::getAlias('@modules'));
        foreach ($fileSystem as $item) {
            if ($item->isDir()) {
                $path = new \SplFileInfo($item);
                $class = 'modules\\' . $path->getBasename() . '\\Module';
                $this->allModules[$path->getBasename()] = $class;
            }
        }
        return $this->allModules;
    }


    public function getAllPlugin(){
        if($this->allPlugin)return $this->allPlugin;

        $fileSystem = new \FilesystemIterator(\Yii::getAlias('@plugins'));
        foreach ($fileSystem as $item) {
            if ($item->isDir()) {
                $path = new \SplFileInfo($item);
                $class = 'plugins\\' . $path->getBasename() . '\\Plugin';
                $this->allPlugin[$path->getBasename()] = $class;
            }
        }
        return $this->allPlugin;
    }


    public function install(Package $package)
    {
        //模块
        if($package->type == 1){
            $instance = \Yii::createObject([
                'class' => $package->class . 'Install',
            ]);
        }else {
            $instance = \Yii::createObject($package->class);
        }
        try {
            if ($instance->install($package)) {
                $package->is_install = 1;
                $package->is_open = 1;
                return $package->save();
            }
            return false;
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public function uninstall(Package $package)
    {
        //模块
        if($package->type == 1){
            $instance = \Yii::createObject([
                'class' => $package->class . 'Install',
            ]);
        }else {
            $instance = \Yii::createObject([
                'class' => $package->class . 'Install'
            ]);
        }
        try {
            if ($instance && $instance->uninstall()) {
                $package->is_install = 0;
                $package->is_open = 0;
                return $package->save();
            }
            return false;
        } catch(\Exception $e) {
            throw $e;
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