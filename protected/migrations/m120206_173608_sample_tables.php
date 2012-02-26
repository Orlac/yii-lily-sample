<?php

class m120206_173608_sample_tables extends CDbMigration
{
	public function safeUp()
	{
        $this->createTable('{{profile}}', array(
            'pid' => 'pk',
            'uid' => 'integer',
            'name' => 'string',
            'birthday' => 'date',
            'sex' => 'boolean'
        ));
        $this->createTable('{{tag1}}', array(
            'tid' => 'pk',
            'name' => 'string',
        ));
        $this->createTable('{{tag1_relation}}', array(
            'tid' => 'integer',
            'uid' => 'integer',
        ));
        $this->createTable('{{tag2}}', array(
            'tid' => 'pk',
            'name' => 'string',
        ));
        $this->createTable('{{tag2_relation}}', array(
            'tid' => 'integer',
            'uid' => 'integer',
        ));
        $this->createTable('{{tag3}}', array(
            'tid' => 'pk',
            'name' => 'string',
        ));
        $this->createTable('{{tag3_relation}}', array(
            'tid' => 'integer',
            'uid' => 'integer',
        ));
        $this->createIndex('tag1_tid_uid', '{{tag1_relation}}', 'tid,uid', true);
        $this->createIndex('tag2_tid_uid', '{{tag2_relation}}', 'tid,uid', true);
        $this->createIndex('tag3_tid_uid', '{{tag3_relation}}', 'tid,uid', true);
	}

	public function safeDown()
	{
        $this->dropTable('{{profile}}');
        $this->dropTable('{{tag1}}');
        $this->dropTable('{{tag1_relation}}');
        $this->dropTable('{{tag2}}');
        $this->dropTable('{{tag2_relation}}');
        $this->dropTable('{{tag3}}');
        $this->dropTable('{{tag3_relation}}');
	}

}