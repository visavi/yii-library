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
    }

    public function down()
    {
        $this->dropTable('users');
    }
}
