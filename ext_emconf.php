<?php

$EM_CONF[$_EXTKEY] = [
    'title' => '(FGTCLB) University Educational Course',
    'description' => 'Educational Course page for TYPO3 with structured data based on sys_category',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.0-11.5.99',
            'category_types' => '*',
        ],
        'conflicts' => [],
        'suggests' => [
            'page_backend_layout' => '1.0-1.99',
        ],
    ],
    'state' => 'beta',
    'version' => '0.1.2',
    'category' => 'fe',
    'author_company' => 'FGTCLB GmbH',
    'author_email' => 'hello@fgtclb.com',
];
