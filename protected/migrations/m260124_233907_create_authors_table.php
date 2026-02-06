<?php

class m260124_233907_create_authors_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('authors', [
            'id' => 'pk',
            'full_name' => 'varchar(255) NOT NULL',
        ]);

        $this->createIndex('idx_authors_full_name', 'authors', 'full_name');
    }

    public function down()
    {
        $this->dropIndex('idx_authors_full_name', 'authors');
        $this->dropTable('authors');
    }
}
