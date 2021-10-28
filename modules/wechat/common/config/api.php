<?php
return [
    'components' => [

    ],
    'modules' => [
        'v1' => [
            'class' => 'modules\wechat\api\modules\v1\Module'
        ],
        'v2' => [
            'class' => 'modules\wechat\api\modules\v2\Module'
        ],
    ],
];