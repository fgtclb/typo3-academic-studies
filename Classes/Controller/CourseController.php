<?php

declare(strict_types=1);

namespace FGTCLB\AcademicStudies\Controller;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Driver\Exception;
use FGTCLB\AcademicStudies\Domain\Collection\CourseCollection;
use FGTCLB\AcademicStudies\Domain\Model\Dto\CourseFilter;
use FGTCLB\AcademicStudies\Domain\Repository\CourseCategoryRepository;
use FGTCLB\AcademicStudies\Exception\Domain\CategoryExistException;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Resource\Exception\FileDoesNotExistException;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class CourseController extends ActionController
{
    protected CourseCategoryRepository $categoryRepository;

    public function __construct(
        CourseCategoryRepository $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @throws Exception
     * @throws DBALException
     * @throws CategoryExistException
     * @throws FileDoesNotExistException
     */
    public function listAction(?CourseFilter $filter = null): ResponseInterface
    {
        $sorting = $this->settings['sorting'] ?? 'title asc';
        if ($filter === null) {
            if (isset($this->settings['categories']) && (int)$this->settings['categories'] > 0) {
                if ($this->configurationManager->getContentObject() !== null) {
                    $uid = $this->configurationManager->getContentObject()->data['uid'];
                    $filterCategories = $this->categoryRepository->getByDatabaseFields($uid);
                    $filter = CourseFilter::createByCategoryCollection($filterCategories);
                }
            }
        }
        $filter ??= CourseFilter::createEmpty();
        $courses = CourseCollection::getByFilter(
            $filter,
            GeneralUtility::intExplode(
                ',',
                $this->configurationManager->getContentObject()
                    ? $this->configurationManager->getContentObject()->data['pages']
                    : []
            ),
            $sorting
        );
        $categories = $this->categoryRepository->findAll();

        $assignedValues = [
            'courses' => $courses,
            'filter' => $filter,
            'categories' => $categories,
        ];
        $this->view->assignMultiple($assignedValues);

        return $this->htmlResponse();
    }
}
