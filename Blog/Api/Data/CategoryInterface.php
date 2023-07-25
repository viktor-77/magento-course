<?php declare(strict_types=1);

namespace Umanskiy\Blog\Api\Data;

/**
 * Category DTO interface.
 */
interface CategoryInterface
{
    public const ID = 'id';
    public const NAME = 'name';
    public const CREATED_AT = 'created_at';
    public const MODIFIED_AT = 'modified_at';

    /**
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * @return string
     */
    public function getCategoryName(): string;

    /**
     * @param string $categoryName
     * @return CategoryInterface
     */
    public function setCategoryName(string $categoryName): CategoryInterface;

    /**
     * @return string
     */
    public function getCreatedAt(): string;

    /**
     * @return string
     */
    public function getModifiedAT(): string;

    /**
     * @param string $time
     * @return CategoryInterface
     */
    public function setModifiedAT(string $time): CategoryInterface;
}
