<?php

use yii\db\Migration;

/**
 * Class m210608_023407_module_plugin
 */
class m210608_023408_module_plugin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%package}}', [
            'id' => $this->primaryKey(),
            'name' => $this->char(100)->comment('name'),
            'class' => $this->char(100)->comment('class'),
            'type' => $this->smallInteger(1)->notNull()->defaultValue(1)->comment('1:module 2:plugin'),
            'bootstrap' => $this->string(250)->defaultValue('*')->comment('模块初始化应用ID'),
            'is_install' => $this->integer(10)->defaultValue(0)->notNull()->comment('1:已安装 0：未安装'),
            'is_open' => $this->integer(10)->defaultValue(0)->notNull()->comment('1:开 0：关'),
            'config' => $this->text()->comment('配置'),
            'created_at' => $this->integer(10)->notNull(),
            'updated_at' => $this->integer(10)->notNull(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210608_023407_module_plugin cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210608_023407_module_plugin cannot be reverted.\n";

        return false;
    }
    */
}
