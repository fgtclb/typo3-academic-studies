<?php

declare(strict_types=1);

namespace FGTCLB\AcademicStudies\Domain\Repository;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Driver\Exception;
use FGTCLB\AcademicStudies\Domain\Collection\CategoryCollection;
use FGTCLB\AcademicStudies\Domain\Enumeration\Category;
use FGTCLB\AcademicStudies\Domain\Model\EducationalCategory;
use FGTCLB\AcademicStudies\Exception\Domain\CategoryExistException;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class EducationalCategoryRepository
{
    /**
     * @throws CategoryExistException
     * @throws DBALException
     * @throws Exception
     */
    public function findChildren(int $uid): ?CategoryCollection
    {
        $db = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('sys_category');
        $statement = $db
            ->select('uid', 'title', 'type')
            ->from('sys_category')
            ->where(
                $db->expr()->eq('parent', $db->createNamedParameter($uid, Connection::PARAM_INT))
            );
        $children = new CategoryCollection();

        $result = $statement->executeQuery()->fetchAllAssociative();

        foreach ($result as $child) {
            $children->attach(
                new EducationalCategory(
                    $child['uid'],
                    Category::cast($child['type']),
                    $child['title']
                )
            );
        }
        return $children;
    }
}
