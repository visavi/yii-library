<?php

class m260124_234149_create_book_author_table extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('book_author', [
            'book_id' => 'integer NOT NULL',
            'author_id' => 'integer NOT NULL',
            'PRIMARY KEY (book_id, author_id)',
        ]);

        $this->addForeignKey('fk_book_author_book', 'book_author', 'book_id', 'books', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_book_author_author', 'book_author', 'author_id', 'authors', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_book_author_book', 'book_author');
        $this->dropForeignKey('fk_book_author_author', 'book_author');
        $this->dropTable('book_author');
    }
}
