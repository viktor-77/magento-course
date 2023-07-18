<?php declare(strict_types=1);

namespace Umanskiy\Blog\Api;

use Umanskiy\Blog\Api\Data\CategoryInterface;

/**
 * Category CRUD interface.
 */
interface CategoryRepositoryInterface
{
    /**
     * @param string $categoryName
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(string $categoryName): bool;

    /**
     * @param int $categoryId
     * @return \Umanskiy\Blog\Api\Data\CategoryInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById(int $categoryId): \Umanskiy\Blog\Api\Data\CategoryInterface;

    /**
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(): array;

    /**
     * @param array $categoryIds
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(array $categoryIds): bool;

    /**
     * @param int $categoryId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById(int $categoryId): bool;
}
