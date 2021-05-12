<?php

use yii\db\Migration;

/**
 * Class m210512_142248_simpleconfig
 */
class m210512_142248_simpleconfig extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%simpleconfig}}', [
            'id' => $this->primaryKey(),
            'name' => $this->char(200)->notNull()->comment('名称'),
            'label'=> $this->char(200)->defaultValue('')->comment('显示名称'),
            'value'=> $this->text()->defaultValue('')->comment('值'),
        ]);
        $this->addCommentOnTable('{{%simpleconfig}}','配置存储');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210512_142248_simpleconfig cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210512_142248_simpleconfig cannot be reverted.\n";

        return false;
    }
    */
}
