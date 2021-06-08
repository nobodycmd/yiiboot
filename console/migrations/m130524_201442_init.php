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
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }


        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

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

