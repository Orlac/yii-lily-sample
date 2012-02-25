<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Lily sample project',
	
	'aliases' => array(
		'lily' => 'application.modules.lily',
	),

    'theme' => 'classic',

	// preloading 'log' component
	'preload'=>array('lilyModuleLoader'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'ext.eoauth.*',
        'ext.eoauth.lib.*',
        'ext.lightopenid.*',
        'ext.eauth.*',
        'ext.eauth.services.*',
        'ext.yii-mail.YiiMailMessage',
	),

	'modules'=>array(
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'abracadabra',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
        'lily' => array(
			'class' => 'lily.LilyModule',
			'relations' => array(
				'profile' => array(
					'relation' => array(CActiveRecord::HAS_ONE, 'Profile', 'uid'),
					'onUserMerge' => 'auto', //event - raise event accross the model, auto, callback - execute callback from callback property, null - do nothing
					'onRegister' => array('profile/edit'), //null isn't required
				),
				'tags' => array(
					'relation' => array(CActiveRecord::MANY_MANY, 'Tag', '{{tag_relation}}(tid, uid)'),
					'onUserMerge' => 'auto', //event - raise event accross the model, auto, null - do nothing
				),
			),
			'userNameFunction' => array('Profile', 'getUserName'),
		),
	),

    'sourceLanguage' => 'en',
    'language' => 'en',
	// application components
	'components'=>array(
        'authManager' => array(
            'class' => 'CPhpAuthManager',
            'defaultRoles' => array('admin'),
        ),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
            'loginUrl' => array('/lily/user/login'),
		),
        'lilyModuleLoader' => array(
            'class' => 'lily.LilyModuleLoader',
        ),
        'loid' => array(
            'class' => 'ext.lightopenid.loid',
        ),
        'eauth' => array(
            'class' => 'ext.eauth.EAuth',
            'popup' => true, // Use the popup window instead of redirecting.
            'services' => require( dirname(__FILE__).'/services.php'),
        ),
        'mail' => array(
            'class' => 'ext.yii-mail.YiiMail',
        ),
		'db'=>require( dirname(__FILE__).'/db.php'),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);
