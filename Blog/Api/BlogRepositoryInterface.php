<?php declare(strict_types=1);

namespace Tsg\Blog\Api;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
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
     * @throws CouldNotSaveException
     */
    public function addRecord(BlogInterface $record): BlogInterface;

//    /**
//     * @param BlogInterface $id
//     * @return BlogInterface
//     * @throws NoSuchEntityException
//     * @throws LocalizedException
//     */
//    public function getById(BlogInterface $id): BlogInterface;
//
//    /**
//     * @return bool
//     * @throws NoSuchEntityException
//     * @throws CouldNotDeleteException
//     * @throws LocalizedException
//     */
//    public function deleteById($id): bool;
//
//    /**
//     * @return bool
//     * @throws CouldNotDeleteException
//     * @throws LocalizedException
//     */
//    public function deleteAll(): bool;
}
