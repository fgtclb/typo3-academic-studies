<?php

declare(strict_types=1);

namespace FGTCLB\AcademicStudies\Domain\Collection;

use ArrayAccess;
use Countable;
use FGTCLB\AcademicStudies\Domain\Enumeration\Category;
use FGTCLB\AcademicStudies\Domain\Model\EducationalCategory;
use FGTCLB\AcademicStudies\Exception\Domain\CategoryExistException;
use Iterator;
use TYPO3\CMS\Core\Type\Exception\InvalidEnumerationValueException;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * @implements Iterator<int, EducationalCategory>
 */
class CategoryCollection implements Countable, Iterator, ArrayAccess
{
    /**
     * @var EducationalCategory[]
     */
    protected array $container = [];

    /**
     * @var array<string, EducationalCategory[]>
     */
    protected array $typeSortedContainer = [
        Category::TYPE_APPLICATION_PERIOD => [],
        Category::TYPE_BEGIN_COURSE => [],
        Category::TYPE_COURSE_TYPE => [],
        Category::TYPE_COSTS => [],
        Category::TYPE_DEGREE => [],
        Category::TYPE_DEPARTMENT => [],
        Category::TYPE_STANDARD_PERIOD => [],
        Category::TYPE_TEACHING_LANGUAGE => [],
        Category::TYPE_TOPIC => [],
    ];
    public function current(): EducationalCategory|false
    {
        return current($this->container);
    }

    public function next(): void
    {
        next($this->container);
    }

    public function key(): string|int|null
    {
        return key($this->container);
    }

    public function valid(): bool
    {
        return current($this->container) !== false;
    }

    public function rewind(): void
    {
        reset($this->container);
    }

    public function count(): int
    {
        return count($this->container);
    }

    /**
     * @throws CategoryExistException
     */
    public function attach(EducationalCategory $category): void
    {
        if (in_array($category, $this->container, true)) {
            throw new CategoryExistException(
                'Category already defined in container.',
                1678979375329
            );
        }
        $this->container[] = $category;
        $this->typeSortedContainer[(string)$category->getType()][] = $category;
    }

    /**
     * @return array<string, EducationalCategory[]>
     */
    public function getAllAttributesByType(): array
    {
        return $this->typeSortedContainer;
    }

    /**
     * @param Category|string $type
     * @return Iterator<int, EducationalCategory>
     */
    public function getAttributesByType(Category|string $type): Iterator
    {
        if (!array_key_exists((string)$type, $this->typeSortedContainer)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Category type "%s" must type of "%s"',
                    $type,
                    Category::class
                ),
                1683633304209
            );
        }
        return new class (
            $this->typeSortedContainer[(string)$type]
        ) implements Iterator, Countable, \JsonSerializable {
            /**
             * @var EducationalCategory[]
             */
            private array $container;

            /**
             * @param EducationalCategory[] $attributes
             */
            public function __construct(array $attributes)
            {
                $this->container = $attributes;
            }
            public function current(): EducationalCategory|false
            {
                return current($this->container);
            }

            public function next(): void
            {
                next($this->container);
            }

            public function key(): string|int|null
            {
                return key($this->container);
            }

            public function valid(): bool
            {
                return current($this->container) !== false;
            }

            public function rewind(): void
            {
                reset($this->container);
            }

            public function count(): int
            {
                return count($this->container);
            }

            public function jsonSerialize(): mixed
            {
                $values = [];
                foreach ($this->container as $category) {
                    $values[] = $category->getUid();
                }
                return $values;
            }
        };
    }

    /**
     * @param array<int|string, mixed> $arguments
     * @throws InvalidEnumerationValueException
     * @return Iterator<int, EducationalCategory>
     */
    public function __call(string $name, array $arguments): Iterator
    {
        $lowerName = GeneralUtility::camelCaseToLowerCaseUnderscored($name);
        $enum = new Category($lowerName);

        return $this->getAttributesByType($enum);
    }

    public function offsetExists(mixed $offset): bool
    {
        if (!is_string($offset)) {
            return false;
        }
        $lowerName = GeneralUtility::camelCaseToLowerCaseUnderscored($offset);
        try {
            $enum = new Category($lowerName);
            return true;
        } catch (InvalidEnumerationValueException $e) {
            return false;
        }
    }

    /**
     * @throws InvalidEnumerationValueException
     */
    public function offsetGet(mixed $offset): Iterator|false|Countable
    {
        if (!is_string($offset)) {
            return false;
        }
        $lowerName = GeneralUtility::camelCaseToLowerCaseUnderscored($offset);
        $enum = new Category($lowerName);

        return $this->getAttributesByType($enum);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        throw new \InvalidArgumentException(
            'Method should never be called',
            1683214236549
        );
    }

    public function offsetUnset(mixed $offset): void
    {
        throw new \InvalidArgumentException(
            'Method should never be called',
            1683214246022
        );
    }
}
