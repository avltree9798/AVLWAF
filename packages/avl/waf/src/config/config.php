<?php
/**
 * Created by PhpStorm.
 * User: avltree
 * Date: 18/09/18
 * Time: 9:11
 */

return [
    'enabled'   => env('WAF_ENABLED', true),
    'blacklist' => [],
    'whitelist' => [],
    'responses' => [
        'blacklist' => [
            'abort'   => false,
            'code'    => 403,
            'message' => json_encode([
                'success' => false,
                'message' => 'You\'ve been banned from this site, by AVL-WAF'
            ])
        ],
        'whitelist' => [
            'code'    => 500,
            'message' => 'Service not available'
        ]
    ],
];