<?php

class m260125_000217_create_author_subscriptions_table extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('author_subscriptions', [
            'id' => 'pk',
            'author_id' => 'integer NOT NULL',
            'phone' => 'varchar(20) NOT NULL',
            'created_at' => 'integer NOT NULL',
        ]);

        $this->createIndex('idx_author_phone', 'author_subscriptions', 'author_id, phone', true);
    }

    public function safeDown()
    {
        $this->dropTable('author_subscriptions');
    }
}
