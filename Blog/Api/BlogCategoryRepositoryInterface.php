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
     * @param string $category
     * @return BlogCategoryInterface
     */
    public function getCategoryByName(string $category): BlogCategoryInterface;

    /**
     * @param BlogCategoryInterface $category
     * @return BlogCategoryInterface
     */
    public function addCategory(BlogCategoryInterface $category): BlogCategoryInterface;

//    /**
//     * @param BlogCategoryInterface $category
//     * @return bool
//     */
//    public function deleteCategoryByName(BlogCategoryInterface $category): bool;

//    /**
//     * @param BlogCategoryInterface $category
//     * @return bool
//     */
//    public function updateCategoryByName(BlogCategoryInterface $category): bool;
}
