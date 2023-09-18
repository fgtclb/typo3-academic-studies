<?php

declare(strict_types=1);

(static function (): void {
    // first add doktype to select
    $studyProgrammeDokType = \FGTCLB\AcademicStudies\Domain\Enumeration\Page::TYPE_ACADEMIC_STUDIES;

    // create new group
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItemGroup(
        'pages',
        'doktype',
        'study',
        'LLL:EXT:academic_studies/Resources/Private/Language/locallang.xlf:pages.study',
        'after:default'
    );
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'pages',
        'doktype',
        [
            'LLL:EXT:academic_studies/Resources/Private/Language/locallang.xlf:pages.academic_studies',
            $studyProgrammeDokType,
            'actions-graduation-cap',
            'study',
        ]
    );
    // add type and typeicon
    \TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule(
        $GLOBALS['TCA']['pages'],
        [
            'ctrl' => [
                'typeicon_classes' => [
                    $studyProgrammeDokType => 'actions-graduation-cap',
                ],
            ],
            'types' => [
                $studyProgrammeDokType => [
                    'showitem' => $GLOBALS['TCA']['pages']['types'][\TYPO3\CMS\Core\Domain\Repository\PageRepository::DOKTYPE_DEFAULT]['showitem'],
                ],
            ],
        ]
    );

    // adds study programme fields
    $newTcaFields = [
        'job_profile' => [
            'label' => 'LLL:EXT:academic_studies/Resources/Private/Language/locallang.xlf:pages.job_profile',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
            ],
        ],
        'performance_scope' => [
            'label' => 'LLL:EXT:academic_studies/Resources/Private/Language/locallang.xlf:pages.performance_scope',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
            ],
        ],
        'prerequisites' => [
            'label' => 'LLL:EXT:academic_studies/Resources/Private/Language/locallang.xlf:pages.prerequisites',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
            ],
        ],
    ];

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
        'pages',
        $newTcaFields
    );
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'pages',
        '--div--;LLL:EXT:academic_studies/Resources/Private/Language/locallang.xlf:pages.div.course_information,job_profile,performance_scope,prerequisites',
        '20',
        'after:rowDescription'
    );
})();
