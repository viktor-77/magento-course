<?php declare(strict_types=1);

namespace Umanskiy\Blog\Api;

/**
 * Post CRUD interface.
 */
interface PostRepositoryInterface
{
    /**
     * @param array $postData
     * @param int|null $id
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(array $postData, ?int $id = null): bool;

    /**
     * @param int $id
     * @return \Umanskiy\Blog\Api\Data\PostInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById(int $id): \Umanskiy\Blog\Api\Data\PostInterface;

    /**
     * @param array $postIds
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(array $postIds): bool;

    /**
     * @param int $id
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById(int $id): bool;
}
