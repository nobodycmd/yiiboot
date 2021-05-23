<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
* @property  int  id      
* @property  varchar  username      
* @property  varchar  auth_key      
* @property  varchar  password_hash      
* @property  varchar  password_reset_token      
* @property  varchar  email      
* @property  smallint  status      
* @property  int  created_at      
* @property  int  updated_at      
*/
class AdminUser  extends \yii\db\ActiveRecord  implements IdentityInterface{



    public function behaviors()
    {
        $ary = parent::behaviors();
        $ary[] =
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                // 'value' => new Expression('NOW()'),
            ];


        return $ary;
    }



    public static function tableName(){
        return 'admin_user';
    }


    public function setAttributes($values, $safeOnly = false)
    {
        parent::setAttributes($values, false);
    }



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

    
}