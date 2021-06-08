<?php


/*
[
'name' => $tableName,
'comment' => $tableComment,
'columns' => $aryColoumns,
'className' => $className,
'traitClassName' => $traitClassName,
'file' => $file,
'filetrait' => $fileTrait,
]
 */


echo '<?php' . PHP_EOL;
?>

namespace backend\models;

use Yii;



/**
* @PROPERTY_BEGIN 千万千万不要删除这行
属性占位符
* @PROPERTY_END  千万千万不要删除这行
*/
class <?= $className ?>  extends \common\models\<?= $className ?>{

<?php
if(file_exists($filetrait)){
    ?>
    use <?=  $traitClassName ?>;
<?php
}
?>


    public function attributeLabels(){


        return parent::attributeLabels() + [
        <?php
        foreach ($columns as $onecolumn){
            ?>

            '<?= $onecolumn['COLUMN_NAME'] ?>' => '<?= $onecolumn['COLUMN_COMMENT'] ?>',

            <?php
        }
        ?>
        ];
    }



    public function rules(){
        return [
            <?php
            foreach ($columns as $onecolumn){
                if(strtoupper($onecolumn['COLUMN_NAME']) == "ID")continue;

                /*
                  \yii\validators\Validator::className()
                  内置  和 模型的自定义方法都行

                https://www.yiiframework.com/doc/api/2.0/yii-validators-validator#$builtInValidators-detail

                https://www.yiiframework.com/doc/api/2.0/yii-base-model#rules()-detail

                */
                ?>


                <?php
                if(strtoupper($onecolumn['IS_NULLABLE']) == 'NO'){
                    ?>
                    [ ['<?= $onecolumn['COLUMN_NAME'] ?>'] , 'required' ],
                    <?php
                }else{
                    continue;
                }
                ?>


                <?php
                if(strpos($onecolumn['DATA_TYPE'],'int') !== false ){
                    ?>
                    [ ['<?= $onecolumn['COLUMN_NAME'] ?>'] , 'integer' ],
                    <?php
                }
                ?>



                <?php
                if(strpos($onecolumn['DATA_TYPE'],'char') !== false && intval($onecolumn['CHARACTER_MAXIMUM_LENGTH']) >0 ){
                    ?>
                    [ ['<?= $onecolumn['COLUMN_NAME'] ?>'] , 'string', 'min'=>0,'max'=> <?=intval($onecolumn['CHARACTER_MAXIMUM_LENGTH']) ?>],
                    <?php
                }
                ?>



                <?php
            }
            ?>
        ];
    }


}