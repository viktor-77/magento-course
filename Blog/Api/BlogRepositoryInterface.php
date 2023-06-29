<?php declare(strict_types=1);

namespace Tsg\Blog\Api;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Tsg\Blog\Api\Data\BlogInterface;

/**
 * Blog repository interface.
 * @api
 * @since 1.0.0
 */
interface BlogRepositoryInterface
{
    /**
     * @param BlogInterface $record
     * @return BlogInterface
     * @throws LocalizedException
     */
    public function addRecord(BlogInterface $record): BlogInterface;

//    /**
//     * @param BlogCategoryInterface $id
//     * @return BlogCategoryInterface
//     * @throws NoSuchEntityException
//     * @throws LocalizedException
//     */
//    public function getById(BlogCategoryInterface $id): BlogCategoryInterface;
//
//    /**
//     * @param BlogCategoryInterface $record
//     * @return bool
//     * @throws NoSuchEntityException
//     * @throws LocalizedException
//     */
//    public function deleteById(BlogCategoryInterface $record): bool;

}
