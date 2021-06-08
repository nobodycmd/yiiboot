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

if(function_exists('phptypename') == false) {
    function phptypename($type)
    {
        switch ($type) {
            case 'char':
            case 'varchar':
                return 'string';
            case 'int':
            case 'smallint':
            case 'bigint':
                return 'integer';

        }
        return $type;
    }
}

$aryColumnName = array_values(array_column($columns,'COLUMN_NAME'));
foreach ($aryColumnName as &$one){
    $one = strtolower($one);
}

echo '<?php' . PHP_EOL;
?>

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
<?= $isIdentifyTable ? 'use yii\web\IdentityInterface;' : '' ?>


/**
<?php
foreach($columns as $oneColumn) {
    ?>
* @property  <?= phptypename($oneColumn['DATA_TYPE']) ?>  $<?= $oneColumn['COLUMN_NAME'] ?> <?= $oneColumn['COLUMN_NAME'] ?>  <?= $oneColumn['COLUMN_COMMENT'] ?>
    <?php
    echo PHP_EOL;
}?>
*/
class <?= $className ?>  extends \yii\db\ActiveRecord <?= $isIdentifyTable ? ' implements IdentityInterface' : '' ?>{

<?php
if(file_exists($filetrait)){
    ?>
    use <?=  $traitClassName ?>;
<?php
}
?>


    public function behaviors()
    {
        $ary = parent::behaviors();
<?php
if(in_array('created_at',$aryColumnName) && in_array('updated_at',$aryColumnName)) {
    ?>
        $ary[] = [
            'class' => TimestampBehavior::className(),
            'attributes' => [
            ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
            ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
            ],
            // if you're using datetime instead of UNIX timestamp:
            // 'value' => new Expression('NOW()'),
        ];

    <?php
}
    ?>

        return $ary;
    }



    public static function tableName(){
        return '<?= $name ?>';
    }


    public function setAttributes($values, $safeOnly = false)
    {
        parent::setAttributes($values, false);
    }


<?php
if($isIdentifyTable) {
    ?>

    /**
    * @inheritdoc
    */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
    * @inheritdoc
    */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne([
            'access_token' => $token,
        ]);
    }

    /**
    * Finds user by username
    *
    * @param string $username
    * @return static|null
    */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
    * Finds user by password reset token
    *
    * @param string $token password reset token
    * @return static|null
    */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
    * Finds out if password reset token is valid
    *
    * @param string $token password reset token
    * @return boolean
    */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
    * @inheritdoc
    */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
    * @inheritdoc
    */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
    * @inheritdoc
    */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
    * Validates password
    *
    * @param string $password password to validate
    * @return boolean if password provided is valid for current user
    */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
    * Generates password hash from password and sets it to the model
    *
    * @param string $password
    */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
    * Generates "remember me" authentication key
    */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
    * Generates new password reset token
    */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
    * Removes password reset token
    */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    <?php
}
?>

}