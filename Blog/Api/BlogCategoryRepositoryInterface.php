<?php declare(strict_types=1);

namespace Tsg\Blog\Api;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Tsg\Blog\Api\Data\BlogCategoryInterface;

/**
 * Blog category repository interface.
 * @api
 * @since 1.0.0
 */
interface BlogCategoryRepositoryInterface
{
    /**
     * @param BlogCategoryInterface $category
     * @return BlogCategoryInterface
     * @throws LocalizedException
     */
    public function addCategory(BlogCategoryInterface $category): BlogCategoryInterface;

    /**
     * @param BlogCategoryInterface $category
     * @return bool
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteCategory(BlogCategoryInterface $category): bool;

    /**
     * @return array|null
     */
    public function getCollection(): ?array;
}
