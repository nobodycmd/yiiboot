<?php

use yii\db\Schema;
use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }


        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),


            'nickname' => "varchar(100) NULL DEFAULT '' COMMENT '昵称'",
            'realname' => "varchar(100) NULL DEFAULT '' COMMENT '真实姓名'",
            'head_portrait' => "varchar(150) NULL DEFAULT '' COMMENT '头像'",
            'current_level' => "tinyint(4) NULL DEFAULT '1' COMMENT '当前级别'",
            'gender' => "tinyint(1) unsigned NULL DEFAULT '0' COMMENT '性别[0:未知;1:男;2:女]'",
            'qq' => "varchar(20) NULL DEFAULT '' COMMENT 'qq'",
            'birthday' => "date NULL COMMENT '生日'",
            'visit_count' => "int(10) unsigned NULL DEFAULT '1' COMMENT '访问次数'",
            'home_phone' => "varchar(20) NULL DEFAULT '' COMMENT '家庭号码'",
            'mobile' => "varchar(20) NULL DEFAULT '' COMMENT '手机号码'",
            'last_time' => "int(10) NULL DEFAULT '0' COMMENT '最后一次登录时间'",
            'last_ip' => "varchar(16) NULL DEFAULT '' COMMENT '最后一次登录ip'",
            'province_id' => "char(20) NULL DEFAULT '0' COMMENT '省'",
            'city_id' => "char(20) NULL DEFAULT '0' COMMENT '城市'",
            'area_id' => "char(20) NULL DEFAULT '0' COMMENT '地区'",
            'pid' => "int(10) unsigned NULL DEFAULT '0' COMMENT '上级id'",
            'level' => "int(10) unsigned NULL DEFAULT '1' COMMENT '级别'",
            'promo_code' => "varchar(50) NULL DEFAULT '' COMMENT '推广码'",


            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->addCommentOnTable('{{%user}}','用户基础表');

        $this->createTable('{{%simpleconfig}}', [
            'id' => $this->primaryKey(),
            'name' => $this->char(200)->notNull()->comment('名称'),
            'label'=> $this->char(200)->defaultValue('')->comment('显示名称'),
            'value'=> $this->text()->defaultValue(null)->comment('值'),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        $this->addCommentOnTable('{{%simpleconfig}}','配置存储');
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
    public static function tableName()
    {
        return '{{%module}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['status', 'type'], 'integer'],
            [['type'], 'in', 'range' => [1, 2]],
            [['name'], 'string', 'max' => 50],
            [['bootstrap'], 'string', 'max' => 128],
            [['config'], 'string'],
            ['status', 'default', 'value' => 1],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'bootstrap' => '初始化的应用',
            'status' => '是否启用',
            'config' => '配置',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

}

