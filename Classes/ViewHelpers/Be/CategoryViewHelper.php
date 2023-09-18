<?php

declare(strict_types=1);

namespace FGTCLB\AcademicStudies\ViewHelpers\Be;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Driver\Exception;
use FGTCLB\AcademicStudies\Domain\Enumeration\Category;
use FGTCLB\AcademicStudies\Domain\Repository\CourseCategoryRepository;
use TYPO3\CMS\Core\Type\Exception\InvalidEnumerationValueException;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

class CategoryViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    protected $escapeOutput = false;

    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument(
            'page',
            'int',
            'Page ID',
            true
        );
        $this->registerArgument(
            'type',
            'string',
            'The type, none given returns all in associative array'
        );
        $this->registerArgument(
            'as',
            'string',
            'The variable name',
            false,
            'courseCategory'
        );
    }

    /**
     * @param array{
     *     page: int,
     *     type: string,
     *     as: string
     * } $arguments
     * @throws DBALException
     * @throws Exception
     */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ): string {
        $templateVariableContainer = $renderingContext->getVariableProvider();

        $repository = GeneralUtility::makeInstance(CourseCategoryRepository::class);
        try {
            $categoryType = Category::cast($arguments['type']);
            $attributes = $repository->findByType($arguments['page'], $categoryType);
        } catch (InvalidEnumerationValueException $e) {
            $attributes = $repository->findAllByPageId($arguments['page']);
        }

        $templateVariableContainer->add($arguments['as'], $attributes);

        $output = $renderChildrenClosure();

        $templateVariableContainer->remove($arguments['as']);

        return $output;
    }
}
