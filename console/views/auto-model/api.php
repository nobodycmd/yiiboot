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

namespace api\models;

use Yii;
<?= $isIdentifyTable ? 'use yii\web\IdentityInterface;' : '' ?>



/**
* @PROPERTY_BEGIN 千万千万不要删除这行
属性占位符
* @PROPERTY_END 千万千万不要删除这行
*/
class <?= $className ?>  extends \common\models\<?= $className ?>  <?= $isIdentifyTable ? ' implements IdentityInterface' : '' ?>{

<?php
if(file_exists($filetrait)){
    ?>
    use <?=  $traitClassName ?>;
<?php
}
?>

        // 过滤掉一些字段，特别用于
        // 你想继承父类实现并不想用一些敏感字段
        public function fields(){
            $fields = parent::fields();

            /*
            接口不反返回id字段
            unset($fields['id']);
            */

            /*
            $fields['customize_filed'] = function($model){
                return 'id is ' . $model->id;
            }
            */
            return $fields;
        }




        public function extraFields()
        {
            return [
                    'profile',
                    'friend' => function ($model) {
                        return [
                            'follow_num' => 1,
                        ];
                    }
            ];
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