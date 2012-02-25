<?php

class m120207_125421_create_user_tag_tables extends CDbMigration {

    public function safeUp() {
        $this->createTable('{{tag}}', array(
            'tid' => 'pk',
            'name' => 'string',
                ));
        $this->createTable('{{tag_relation}}', array(
            'tid' => 'integer',
            'uid' => 'integer',
                ));
    }

    public function safeDown() {
        $this->dropTable('{{user_tag}}');
        $this->dropTable('{{user_tag_relation}}');
    }

}