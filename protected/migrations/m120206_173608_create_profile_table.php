<?php

class m120206_173608_create_profile_table extends CDbMigration
{
	public function up()
	{
            $this->createTable('{{profile}}', array(
            'pid' => 'pk',
            'uid' => 'integer',
            'name' => 'string',
            'birthday' => 'date',
            'sex' => 'boolean'
        ));
	}

	public function down()
	{
		$this->dropTable('{{profile}}');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}