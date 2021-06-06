<?php
namespace console\controllers;


class AutoModelController extends \yii\console\Controller{

    public $layout = false;

    public function actionIndex($autoProperty = false){

        //几个目标项目文件夹
        $alians = [
            'common',
            'backend',
            'api',
        ];

        foreach ($alians as $i => $a) {
            if(file_exists(\Yii::getAlias("@$a")) == false ){
                echo " 不存在项目文件夹  $a  ,将不生成该项目的 文件" . PHP_EOL;
                unset($alians[$i]);
            }
        }

        //用户表和后台用户用户表
        $aryIdentifyTable = [
            'user',
            'admin_user',
        ];

        $dsn = \Yii::$app->db->dsn;
        $dbName = substr(strrchr($dsn, '='), 1);
        $dbname = str_replace(';','',$dbName);

        $aryTables = \Yii::$app->db->createCommand("select table_name,table_comment from information_schema.tables where table_schema='$dbname'")->queryAll();
        foreach($aryTables as $oneTable){

            $tableName = $oneTable['table_name'];
            $tableComment = $oneTable['table_comment'];
            $aryColoumns = \Yii::$app->db->createCommand("select * from information_schema.`COLUMNS` where table_schema='$dbname' and TABLE_NAME='$tableName'")->queryAll();

            $className = '';
            $_aryName = explode('_',$tableName);
            foreach ($_aryName as $one){
                $className .= ucfirst($one);
            }

            $traitClassName = "{$className}Trait";

            foreach ($alians as $a){
                $renderfile = \Yii::getAlias("@console/views/auto-model/$a.php");
                if(file_exists($renderfile) == false){
                    echo 'render file ' . $renderfile . ' is not exists ' . PHP_EOL;
                    continue;
                }
                $file = \Yii::getAlias("@{$a}/models/{$className}.php");
                $fileTrait = \Yii::getAlias("@{$a}/models/{$traitClassName}.php");

                if($a == 'common') {
                    $content = $this->render($a, [
                        'name' => $tableName,
                        'comment' => $tableComment,
                        'columns' => $aryColoumns,
                        'className' => $className,
                        'file' => $file,
                        'filetrait' => $fileTrait,
                        'traitClassName' => $traitClassName,
                        'isIdentifyTable' => in_array($tableName, $aryIdentifyTable),
                    ]);
                    @file_put_contents($file, $content);
                }else {

                    if (file_exists($file) == false) {
                        $content = $this->render($a, [
                            'name' => $tableName,
                            'comment' => $tableComment,
                            'columns' => $aryColoumns,
                            'className' => $className,
                            'file' => $file,
                            'filetrait' => $fileTrait,
                            'traitClassName' => $traitClassName,
                            'isIdentifyTable' => in_array($tableName, $aryIdentifyTable),
                        ]);
                        @file_put_contents($file, $content);
                    }

                    if(boolval($autoProperty)) {
                        //读取最新的数据库字段
                        /**
                         * @PROPERTY_BEGIN
                        属性占位符
                         * @PROPERTY_END
                         */
                        $propertyTextForPlaceHolder = $this->render('property', ['columns' => $aryColoumns,]);
                        $propertyTextForPlaceHolder .= PHP_EOL . 'auto replace propery at ' . date('Y-m-d H:i:s') . PHP_EOL;

                        $lines = file($file);
                        $startLine = 0;
                        foreach ($lines as $i => $line) {
                            //echo 'row '.$i.' : ' . $line . PHP_EOL;
                            //到了class 申明直接退出
                            if(
                                strpos($line, 'class') !== false
                                &&strpos($line, 'extends') !== false
                                &&strpos($line, 'common')  !== false
                                &&strpos($line, 'models')  !== false
                            ){
                                break;
                            }
                            //PROPERTY_BEGIN
                            if (strpos($line, 'PROPERTY_BEGIN') !== false) {
                                $startLine = $i;
                            }else {
                                if ($startLine > 0 && strpos($line, 'PROPERTY_END') === false) {
                                    unset($lines[$i]);
                                }
                                if ($startLine > 0 && strpos($line, 'PROPERTY_END') !== false) {
                                    break;
                                }
                            }
                        }

                        //echo "startLine is $startLine";exit;
                        if($startLine > 0) {
                            array_splice($lines, $startLine + 1, 0, $propertyTextForPlaceHolder);

                            @file_put_contents($file, implode('', $lines));
                        }
                    }

                }

            }

            echo 'model code was done for table '.$tableName  . PHP_EOL;

        }

        echo count($aryTables) .' tables were done!';

    }

}
