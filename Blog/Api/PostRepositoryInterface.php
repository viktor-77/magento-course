<?php declare(strict_types=1);

namespace Umanskiy\Blog\Api;

use Umanskiy\Blog\Api\Data\PostInterface;

/**
 * Post CRUD interface.
 */
interface PostRepositoryInterface
{
    /**
     * @param array $postData
     * @param int|null $id
     * @return bool
     */
    public function save(array $postData, ?int $id = null): bool;

    /**
     * @param int $id
     * @return \Umanskiy\Blog\Api\Data\PostInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById(int $id): \Umanskiy\Blog\Api\Data\PostInterface;

    /**
     * @param array $postIds
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(array $postIds): bool;

    /**
     * @param int $id
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById(int $id): bool;
}
