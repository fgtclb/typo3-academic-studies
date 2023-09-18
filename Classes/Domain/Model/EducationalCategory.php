<?php

declare(strict_types=1);

namespace FGTCLB\AcademicStudies\Domain\Model;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Driver\Exception;
use FGTCLB\AcademicStudies\Domain\Collection\CategoryCollection;
use FGTCLB\AcademicStudies\Domain\Enumeration\Category;
use FGTCLB\AcademicStudies\Domain\Repository\EducationalCategoryRepository;
use FGTCLB\AcademicStudies\Exception\Domain\CategoryExistException;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class EducationalCategory
{
    protected int $uid;

    protected Category $type;

    protected string $title;

    protected ?CategoryCollection $children = null;

    /**
     * @throws CategoryExistException
     * @throws DBALException
     * @throws Exception
     */
    public function __construct(
        int $uid,
        Category $type,
        string $title
    ) {
        $this->uid = $uid;
        $this->type = $type;
        $this->title = $title;
        $this->children = GeneralUtility::makeInstance(EducationalCategoryRepository::class)
            ->findChildren($this->uid);
    }

    public function getUid(): int
    {
        return $this->uid;
    }

    public function getType(): Category
    {
        return $this->type;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getChildren(): ?CategoryCollection
    {
        return $this->children;
    }
}
