<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%following}}`.
 */
class m191028_071919_create_following_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%following}}', [
            'id' => $this->primaryKey(),
            'screen_name' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%following}}');
    }
}
