<?php

class m260123_131125_create_books_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('books', [
            'id' => 'pk',
            'title' => 'varchar(255) NOT NULL',
            'year' => 'integer NOT NULL',
            'description' => 'text',
            'isbn' => 'varchar(32) UNIQUE',
            'cover_image' => 'varchar(255)',
            'created_at' => 'integer',
        ]);
    }

    public function down()
    {
        $this->dropTable('books');
    }
}
