<?php

class m260124_235725_seed_books_and_authors extends CDbMigration
{
    public function up()
    {
        // Авторы
        $this->insert('authors', array('full_name' => 'Лев Толстой'));
        $this->insert('authors', array('full_name' => 'Фёдор Достоевский'));
        $this->insert('authors', array('full_name' => 'Михаил Булгаков'));
        $this->insert('authors', array('full_name' => 'Антуан де Сент-Экзюпери'));
        $this->insert('authors', array('full_name' => 'Джордж Оруэлл'));

        // Книги
        $this->insert('books', array(
            'title' => 'Война и мир',
            'year' => 1869,
            'isbn' => '978-5-123456-78-9',
            'description' => 'Эпопея о жизни русского общества.',
            'cover_image' => 'books/voyna.jpeg',
            'created_at' => time(),
        ));

        $this->insert('books', array(
            'title' => 'Преступление и наказание',
            'year' => 1866,
            'isbn' => '978-5-123456-79-6',
            'description' => 'Роман о студенте Раскольникове.',
            'cover_image' => 'books/prestuplenie.webp',
            'created_at' => time(),
        ));

        $this->insert('books', array(
            'title' => 'Мастер и Маргарита',
            'year' => 1967,
            'isbn' => '978-5-123456-80-2',
            'description' => 'Роман о дьяволе в Москве.',
            'cover_image' => 'books/master.webp',
            'created_at' => time(),
        ));

        $this->insert('books', array(
            'title' => 'Маленький принц',
            'year' => 1943,
            'isbn' => '978-5-123456-81-9',
            'description' => 'Сказка для взрослых.',
            'cover_image' => '',
            'created_at' => time(),
        ));

        $this->insert('books', array(
            'title' => '1984',
            'year' => 1949,
            'isbn' => '978-5-123456-82-6',
            'description' => 'Антиутопия о тоталитаризме.',
            'cover_image' => '',
            'created_at' => time(),
        ));

        $this->insert('books', array(
            'title' => 'Сборник философских притч',
            'year' => 2020,
            'isbn' => '978-5-123456-83-3',
            'description' => 'Совместный сборник.',
            'cover_image' => '',
            'created_at' => time(),
        ));

        // Связи книга-автор
        $this->insert('book_author', array('book_id' => 1, 'author_id' => 1));
        $this->insert('book_author', array('book_id' => 2, 'author_id' => 2));
        $this->insert('book_author', array('book_id' => 3, 'author_id' => 3));
        $this->insert('book_author', array('book_id' => 4, 'author_id' => 4));
        $this->insert('book_author', array('book_id' => 5, 'author_id' => 5));
        $this->insert('book_author', array('book_id' => 5, 'author_id' => 1));
        $this->insert('book_author', array('book_id' => 6, 'author_id' => 2));
        $this->insert('book_author', array('book_id' => 6, 'author_id' => 4));
    }

        public function down()
    {
        $this->execute('TRUNCATE book_author');
        $this->execute('TRUNCATE books');
        $this->execute('TRUNCATE authors');
    }
}
