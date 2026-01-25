<?php

class m260124_233907_create_authors_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('authors', [
            'id' => 'pk',
            'full_name' => 'varchar(255) NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('authors');
    }
}
