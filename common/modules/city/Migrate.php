<?php
namespace common\modules\city;

use yii\db\Migration;


class migrate extends Migration
{
    /**
     * @inheritdoc
     *
     */
    public function safeUp()
    {
        $this->createTable('{{%city}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('地区名'),
            'parent_id' => $this->integer()->notNull()->comment('父ID'),
            'sort' => $this->integer()->comment('排序'),
            'deep' => $this->integer()->notNull()->comment('地区深度'),
        ]);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        //$this->dropTable('{{%city}}');
    }
}
