<?php declare(strict_types=1);

namespace Umanskiy\Blog\Api;

/**
 * Category CRUD interface.
 */
interface CategoryRepositoryInterface
{
    /**
     * @param string $categoryName
     * @param int|null $id
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(string $categoryName, ?int $id = null): bool;

    /**
     * @param int $id
     * @return \Umanskiy\Blog\Api\Data\CategoryInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById(int $id): \Umanskiy\Blog\Api\Data\CategoryInterface;

    /**
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(): array;

    /**
     * @param array $categoryIds
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(array $categoryIds): bool;

    /**
     * @param int $id
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById(int $id): bool;
}
