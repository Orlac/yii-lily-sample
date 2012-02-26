<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',
	// application components
	'components'=>array(
		'db'=>require( dirname(__FILE__).'/db.php'),
//        'db2' => array(
//            'class' => 'CDbConnection',
//            'connectionString' => 'mysql:host=localhost;dbname=lily_sample',
//            'emulatePrepare' => true,
//            'username' => 'lily_sample',
//            'password' => 'abcdef',
//            'charset' => 'utf8',
//            'tablePrefix' => 'tbl_',
//        ),
	),
    'commandMap' => array(
        'dbinstall' => array(
            'class' => 'application.commands.DbInstall',
//            'connectionIds' => array('db', 'db2')
        ),
    ),

);
