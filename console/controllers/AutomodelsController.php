<?php
namespace console\controllers;

use yii\helpers\StringHelper;

class AutomodelsController extends \yii\console\Controller{
    /**
     * yii automodels/go
     * 自动生成数据库的MODEL层
     */
    public function actionGo(){
        $dsn = \Yii::$app->db->dsn;
        $dbName = substr(strrchr($dsn, '='), 1);
        $dbname = str_replace(';','',$dbName);
        //echo $dbname;exit;
        $aryTables = \Yii::$app->db->createCommand("select table_name,table_comment from information_schema.tables where table_schema='$dbname'")->queryAll();
        foreach($aryTables as $oneTable){
            $tableName = $oneTable['table_name'];
            $tableComment = $oneTable['table_comment'];

            if(
                StringHelper::startsWith(strtolower($tableName),'admin_')
            ||
                StringHelper::startsWith(strtolower($tableName),'zb_')
                ||
                in_array(strtolower($tableName),[
                    'base_user',
                    'user_order',
                ])
            ){
                //echo $tableName . '   ' . PHP_EOL;
            }else{
                    continue;
            }

            /*if(  strtolower($tableName) == 'user'){
            	echo 'skip user table................' . PHP_EOL;
            	continue;
            }*/
            
            $fileC = '<?php'.PHP_EOL;
            $fileC .= 'namespace common\models;'.PHP_EOL;
            $fileC .= 'use Yii;'.PHP_EOL;
            $fileC .= '/**'.PHP_EOL;
            $fileC .= '* 代码自动生成 '.$tableName.'-'.$tableComment.'表的模型 '.PHP_EOL;
            $fileC .= '* 需要给模型新增方法就创建 '.ucfirst($tableName).'Trait'.' 后执行automodels会进行自动关联 '.PHP_EOL;

            $aryColoumns = \Yii::$app->db->createCommand("select COLUMN_NAME,DATA_TYPE,COLUMN_COMMENT,COLUMN_TYPE,CHARACTER_MAXIMUM_LENGTH,COLUMN_KEY from information_schema.`COLUMNS` where table_schema='$dbname' and TABLE_NAME='$tableName'")->queryAll();
            foreach($aryColoumns as $oneColumn){
                $fileC .= '* @property '.self::getType($oneColumn['DATA_TYPE']).' $'.$oneColumn['COLUMN_NAME'] .'   '.$oneColumn['COLUMN_COMMENT']. PHP_EOL;
            }

            $fileC .= '*/'.PHP_EOL;
            $fileC .= 'class '.ucfirst($tableName).' extends \yii\db\ActiveRecord'.PHP_EOL;
            $fileC .= '{'.PHP_EOL;

            if(file_exists(dirname(__DIR__).'/../common/models/'.ucfirst($tableName).'Trait.php')){
                $fileC .='      use '.ucfirst($tableName).'Trait;' . PHP_EOL;
            }

            $fileC .= '     public static function tableName(){' . PHP_EOL;
            $fileC .= "         return '$tableName';" . PHP_EOL;
            $fileC .= '     }'. PHP_EOL;

            /*
            foreach($aryColoumns as $oneColumn){
                $fileC .= 'private $'.$oneColumn['COLUMN_NAME'].';'.PHP_EOL;
            }

            foreach($aryColoumns as $oneColumn){
                $fileC .= '     public function get'.$oneColumn['COLUMN_NAME'].'(){return $this->'.$oneColumn['COLUMN_NAME'].';}'.PHP_EOL;
                $fileC .= '     public function set'.$oneColumn['COLUMN_NAME'].'($value){$this->'.$oneColumn['COLUMN_NAME'].'=$value;return $this;}'.PHP_EOL;
            }
            */

            $fileC .= '}'.PHP_EOL;

            file_put_contents(dirname(__DIR__).'/../common/models/'.ucfirst($tableName).'.php',$fileC);

            echo 'table '.$tableName.' was build'.PHP_EOL;


        }

        echo count($aryTables) .' tables were done!';
    }
    
    private static function getImigrateType($tableName, $columnName , $type, $length=null){
    	$type = strtolower($type);
    	if($type=='varchar'){
    		return "string($length)->defaultValue('')";
    	}
    	if($type=='char'){
    		return "char($length)->defaultValue('')";
    	}
    	if($type=='int'||strpos($type,'int')){
    		return 'integer()';
    	}
    	if($type=='decimal'||strpos($type,'decimal')||$type=='float'){
    		return 'decimal(10,2)->defaultValue(0)';
    	}
    	if($type=='datetime'){
    		return 'dateTime()';
    	}
    	//在有些版本里面text/blod类型不能有默认值
        if($type=='text'||strpos($type,'text')){
            return "text()";
        }
        if($type=='blob'||strpos($type,'blob')){
            return "binary()";
        }
        if($type=='enum'){
        	echo ' WARNING: ' . $tableName . ' . ' . $columnName . ' is ' . $type . PHP_EOL;
        	exit;
        }
    	return "$type()";
    }

    private static function getType($type){
        $type = strtolower($type);
        if($type=='char'||$type=='text'||strpos($type,'char')){
            return 'string';
        }
        if($type=='int'||strpos($type,'int')){
            return 'integer';
        }
        if($type=='decimal'||strpos($type,'decimal')){
            return 'float';
        }
        return $type;
    }
}
