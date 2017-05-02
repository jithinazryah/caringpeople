<?php

$params = array_merge(
	require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
	'gii' => [
	    'class' => 'yii\gii\Module',
	    'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '192.168.178.20'], // adjust this to your needs
	    'generators' => [//here
		'crud' => [// generator name
		    'class' => 'yii\gii\generators\crud\Generator', // generator class
		    'templates' => [//setting for out templates
			'custom' => '@common/myTemplates/crud/custom', // template name => path to template
		    ]
		]
	    ],
	],
	'admin' => [
	    'class' => 'backend\modules\admin\Module',
	],
	'masters' => [
	    'class' => 'backend\modules\masters\Module',
	],
	'enquiry' => [
	    'class' => 'backend\modules\enquiry\Module',
	],
	'staff' => [
	    'class' => 'backend\modules\staff\Module',
	],
	'followup' => [
	    'class' => 'backend\modules\followup\Module',
	],
	'patient' => [
	    'class' => 'backend\modules\patient\Module',
	],
	'attendance' => [
	    'class' => 'backend\modules\attendance\Module',
	],
	'directory' => [
	    'class' => 'backend\modules\directory\Module',
	],
	'leave' => [
	    'class' => 'backend\modules\leave\Module',
	],
	'services' => [
	    'class' => 'backend\modules\services\Module',
	],
    ],
    'components' => [
	'request' => [
	    'csrfParam' => '_csrf-backend',
	],
	'user' => [
	    // 'identityClass' => 'common\models\AdminUsers',
	    'identityClass' => 'common\models\StaffInfo',
	    'enableAutoLogin' => true,
	    'loginUrl' => ['site/index'],
	    'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
	],
	'session' => [
	    // this is the name of the session cookie used for login on the backend
	    'name' => 'advanced-backend',
	],
	'log' => [
	    'traceLevel' => YII_DEBUG ? 3 : 0,
	    'targets' => [
		    [
		    'class' => 'yii\log\FileTarget',
		    'levels' => ['error', 'warning'],
		],
	    ],
	],
	'errorHandler' => [
	    'errorAction' => 'site/error',
	],
	'urlManager' => [
	    'enablePrettyUrl' => true,
	    'showScriptName' => false,
	    'rules' =>
	    require(__DIR__ . '/url_rules.php')
	],
	'assetManager' => [
	    'bundles' => [
		'yii\web\JqueryAsset' => [
		    'js' => []
		],
		'yii\bootstrap\BootstrapAsset' => [
		    'css' => [],
		],
	    ],
	],
    ],
    'params' => $params,
];
