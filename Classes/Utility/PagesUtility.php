<?php

declare(strict_types=1);

namespace FGTCLB\AcademicStudies\Utility;

use TYPO3\CMS\Core\Domain\Repository\PageRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;

final class PagesUtility
{
    /**
     * @param int[] $pageIds
     * @return int[]
     */
    public static function getPagesRecursively(array $pageIds): array
    {
        $pageRepository = GeneralUtility::makeInstance(PageRepository::class);
        $foundSubPages = [];
        do {
            $subPages = $pageRepository->getMenu($pageIds, 'uid');
            $pageIds = array_keys($subPages);
            $foundSubPages = array_merge($foundSubPages, $pageIds);
        } while (count($subPages));
        return array_unique($foundSubPages);
    }
}
