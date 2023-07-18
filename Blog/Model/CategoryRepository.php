<?php declare(strict_types=1);

namespace Umanskiy\Blog\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Umanskiy\Blog\Api\CategoryRepositoryInterface;
use Umanskiy\Blog\Api\Data\CategoryInterface;
use Umanskiy\Blog\Model\ResourceModel\Category as ResourceModel;
use Umanskiy\Blog\Model\CategoryFacory;
use Umanskiy\Blog\Model\ResourceModel\Category\CollectionFactory;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected CollectionFactory $collectionFactory;
    private ResourceModel $resourceModel;
    private categoryFactory $categoryFactory;

    /**
     * @param ResourceModel $resourceModel
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(ResourceModel $resourceModel, CollectionFactory $collectionFactory, CategoryFactory $categoryFactory)
    {
        $this->resourceModel = $resourceModel;
        $this->collectionFactory = $collectionFactory;
        $this->categoryFactory = $categoryFactory;
    }

    /**
     * @param string $categoryName
     * @return bool
     * @throws CouldNotSaveException
     */
    public function save(string $categoryName): bool
    {
        try {
            $this->resourceModel->save(
                $this->categoryFactory->create()->setData(CategoryInterface::CATEGORY_NAME, $categoryName)
            );
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('Could not save the tag: %1', $e->getMessage()), $e);
        }

        return true;
    }

    /**
     * @param int $categoryId
     * @return CategoryInterface
     */
    public function getById(int $categoryId): \Umanskiy\Blog\Api\Data\CategoryInterface
    {
        return $this->categoryFactory->create()->load($categoryId);
    }

    /**
     * @return array
     */
    public function getList(): array
    {
        return $this->collectionFactory->create()->load()->getData();
    }

    /**
     * @param array $categoryIds
     * @return bool
     */
    public function delete(array $categoryIds): bool
    {
        foreach ($categoryIds as $categoryId) {
            $this->deleteById($categoryId);
        }
        return true;
    }

    /**
     * @param int $categoryId
     * @return bool
     */
    public function deleteById(int $categoryId): bool
    {
        try {
            $connection = $this->resourceModel->getConnection();
            $connection->delete(ResourceModel::TABLE_NAME, ["id = $categoryId"]);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__('Could not save the tag: %1', $e->getMessage()), $e);
        }

        return true;
    }
}
