<?php

(static function (): void {
    $studyProgrammeDokType = \FGTCLB\AcademicStudies\Domain\Enumeration\Page::TYPE_ACADEMIC_STUDIES;

    $GLOBALS['PAGES_TYPES'][$studyProgrammeDokType] = [
        'type' => 'web',
        'allowedTables' => '*',
    ];
})();
