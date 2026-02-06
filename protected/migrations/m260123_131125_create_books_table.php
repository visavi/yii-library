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

        $this->createIndex('idx_books_title_created_at', 'books', 'title, created_at');
        $this->createIndex('idx_books_year_created_at', 'books', 'year, created_at');
        $this->createIndex('idx_books_created_at', 'books', 'created_at');
    }

    public function down()
    {
        $this->dropIndex('idx_books_title_created_at', 'books');
        $this->dropIndex('idx_books_year_created_at', 'books');
        $this->dropIndex('idx_books_created_at', 'books');
        $this->dropTable('books');
    }
}
