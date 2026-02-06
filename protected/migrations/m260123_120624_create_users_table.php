<?php

class m260123_120624_create_users_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('users', [
            'id' => 'pk',
            'username' => 'varchar(64) NOT NULL UNIQUE',
            'password' => 'varchar(128) NOT NULL',
            'email' => 'varchar(128)',
            'created_at' => 'integer',
        ]);

        $this->createIndex('idx_users_username_created_at', 'users', 'username, created_at');
        $this->createIndex('idx_users_created_at', 'users', 'created_at');
    }

    public function down()
    {
        $this->dropIndex('idx_users_username_created_at', 'users');
        $this->dropIndex('idx_users_created_at', 'users');
        $this->dropTable('users');
    }
}
