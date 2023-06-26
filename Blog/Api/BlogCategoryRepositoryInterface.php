<?php declare(strict_types=1);

namespace Tsg\Blog\Api;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Blog category repository interface.
 * @api
 * @since 1.0.0
 */
interface BlogCategoryRepositoryInterface
{
    /**
     * @param int $id
     * @return BlogCategoryInterface
     * @throws LocalizedException
     */
    public function getTagById(int $id);
//
//    /**
//     * @param BlogCategoryInterface $tag
//     * @return BlogCategoryInterface
//     * @throws LocalizedException
//     */
//    public function saveNewTag(BlogCategoryInterface $tag): BlogCategoryInterface;
//
//    /**
//     * @param BlogCategoryInterface $tag
//     * @return BlogCategoryInterface
//     * @throws LocalizedException
//     * @throws NoSuchEntityException
//     */
//    public function deleteTagById(BlogCategoryInterface $tag): bool;
}
