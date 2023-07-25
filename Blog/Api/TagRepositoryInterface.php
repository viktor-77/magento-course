<?php declare(strict_types=1);

namespace Umanskiy\Blog\Api;

/**
 * Tag CRUD interface.
 */
interface TagRepositoryInterface
{
    /**
     * @param string $tagName
     * @param int|null $id
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(string $tagName, ?int $id = NULL): bool;

    /**
     * @param int $tagId
     * @return \Umanskiy\Blog\Api\Data\TagInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById(int $tagId): \Umanskiy\Blog\Api\Data\TagInterface;

    /**
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(): array;

    /**
     * @param array $tagIds
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(array $tagIds): bool;

    /**
     * @param int $id
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById(int $id): bool;
}
