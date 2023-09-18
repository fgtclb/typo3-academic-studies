<?php

declare(strict_types=1);

(static function (): void {
    $llBackendType = function (string $label) {
        return sprintf('LLL:EXT:academic_studies/Resources/Private/Language/locallang.xlf:sys_category.type.%s', $label);
    };

    $iconType = function (string $iconType) {
        return sprintf(
            'academic-studies-%s',
            $iconType
        );
    };

    $sysCategoryTcaTypeIconOverrides = [
        'ctrl' => [
            'typeicon_classes' => [
                \FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_ADMISSION_RESTRICTION
                => $iconType(\FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_ADMISSION_RESTRICTION),
                \FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_APPLICATION_PERIOD
                => $iconType(\FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_APPLICATION_PERIOD),
                \FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_BEGIN_COURSE
                => $iconType(\FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_BEGIN_COURSE),
                \FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_COSTS
                => $iconType(\FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_COSTS),
                \FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_DEGREE
                => $iconType(\FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_DEGREE),
                \FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_DEPARTMENT
                => $iconType(\FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_DEPARTMENT),
                \FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_STANDARD_PERIOD
                => $iconType(\FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_STANDARD_PERIOD),
                \FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_COURSE_TYPE
                => $iconType(\FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_COURSE_TYPE),
                \FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_TEACHING_LANGUAGE
                => $iconType(\FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_TEACHING_LANGUAGE),
                \FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_TOPIC
                => $iconType(\FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_TOPIC),
            ],
        ],
    ];
    $addItems = [
        [
            $llBackendType(\FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_ADMISSION_RESTRICTION),
            \FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_ADMISSION_RESTRICTION,
            $iconType(\FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_ADMISSION_RESTRICTION),
            'courses',
        ],
        [
            $llBackendType(\FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_APPLICATION_PERIOD),
            \FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_APPLICATION_PERIOD,
            $iconType(\FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_APPLICATION_PERIOD),
            'courses',
        ],
        [
            $llBackendType(\FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_BEGIN_COURSE),
            \FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_BEGIN_COURSE,
            $iconType(\FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_BEGIN_COURSE),
            'courses',
        ],
        [
            $llBackendType(\FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_COSTS),
            \FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_COSTS,
            $iconType(\FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_COSTS),
            'courses',
        ],
        [
            $llBackendType(\FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_DEGREE),
            \FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_DEGREE,
            $iconType(\FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_DEGREE),
            'courses',
        ],
        [
            $llBackendType(\FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_DEPARTMENT),
            \FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_DEPARTMENT,
            $iconType(\FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_DEPARTMENT),
            'courses',
        ],
        [
            $llBackendType(\FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_STANDARD_PERIOD),
            \FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_STANDARD_PERIOD,
            $iconType(\FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_STANDARD_PERIOD),
            'courses',
        ],
        [
            $llBackendType(\FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_COURSE_TYPE),
            \FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_COURSE_TYPE,
            $iconType(\FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_COURSE_TYPE),
            'courses',
        ],
        [
            $llBackendType(\FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_TEACHING_LANGUAGE),
            \FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_TEACHING_LANGUAGE,
            $iconType(\FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_TEACHING_LANGUAGE),
            'courses',
        ],
        [
            $llBackendType(\FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_TOPIC),
            \FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_TOPIC,
            $iconType(\FGTCLB\AcademicStudies\Domain\Enumeration\Category::TYPE_TOPIC),
            'courses',
        ],
    ];

    // create new group
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItemGroup(
        'sys_category',
        'type',
        'courses',
        'LLL:EXT:academic_studies/Resources/Private/Language/locallang.xlf:sys_category.courses',
    );

    foreach ($addItems as $addItem) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
            'sys_category',
            'type',
            $addItem
        );
    }

    \TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule(
        $GLOBALS['TCA']['sys_category'],
        $sysCategoryTcaTypeIconOverrides
    );

    $GLOBALS['TCA']['tt_content']['columns']['tx_migrations_version'] = [
        'config' => [
            'type' => 'passthrough',
        ],
    ];
})();
