<?php

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone' => 'Asia/Kolkata',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'SetValues' => [
            'class' => 'common\components\SetValues'
        ],
        'UploadFile' => [
            'class' => 'common\components\UploadFile'
        ],
        'NumToWord' => [
            'class' => 'common\components\NumToWord'
        ],
        'EncryptDecrypt' => [
            'class' => 'common\components\EncryptDecrypt'
        ],
        'History' => [
            'class' => 'common\components\History'
        ],
        'Followups' => [
            'class' => 'common\components\Followups'
        ],
    ],
];
