<?php declare(strict_types=1);

namespace Umanskiy\Blog\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Message\ManagerInterface;
use Umanskiy\Blog\Api\CategoryRepositoryInterface;
use Umanskiy\Blog\Model\ResourceModel\Category as ResourceModel;
use Umanskiy\Blog\Model\ResourceModel\Category\CollectionFactory;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected CollectionFactory $collectionFactory;
    private ResourceModel $resourceModel;
    private CategoryFactory $categoryFactory;
    private ManagerInterface $messageManager;

    /**
     * @param ResourceModel $resourceModel
     * @param CollectionFactory $collectionFactory
     * @param \Umanskiy\Blog\Model\CategoryFactory $categoryFactory
     */
    public function __construct(ResourceModel $resourceModel, CollectionFactory $collectionFactory, CategoryFactory $categoryFactory, ManagerInterface $messageManager)
    {
        $this->resourceModel = $resourceModel;
        $this->collectionFactory = $collectionFactory;
        $this->categoryFactory = $categoryFactory;
        $this->messageManager = $messageManager;
    }

    /**
     * @param string $tagName
     * @param int|null $id
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(string $tagName, ?int $id = null): bool
    {
        try {
            if ($id) {
                $tagData = $this->getById($id);
            } else {
                $tagData = $this->categoryFactory->create();
            }
            $this->resourceModel->save($tagData->setCategoryName($tagName));
        } catch (\Exception $e) {
            if ($e->getMessage() === 'Unique constraint violation found') {
                $this->messageManager->addErrorMessage(__('Category with the same name already exists.'));

                return false;
            }
            throw new CouldNotSaveException(__('Could not save the category: %1', $e->getMessage()));
        }

        return true;
    }

    /**
     * @param int $id
     * @return \Umanskiy\Blog\Api\Data\CategoryInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById(int $id): \Umanskiy\Blog\Api\Data\CategoryInterface
    {
        try {
            $category = $this->categoryFactory->create()->load($id);
        } catch (\Exception $e) {
            throw new NoSuchEntityException(__('Could not save the category: %1', $e->getMessage()), $e);
        }

        return $category;
    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(): array
    {
        try {
            $list = $this->collectionFactory->create()->load()->getData();
        } catch (\Exception $e) {
            throw new LocalizedException(__('Could not save the category: %1', $e->getMessage()), $e);
        }

        return $list;
    }

    /**
     * @param int $id
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById(int $id): bool
    {
        try {
            $connection = $this->resourceModel->getConnection();
            $connection->delete(ResourceModel::TABLE_NAME, ["id = $id"]);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__('Could not delete the category: %1', $id, $e->getMessage()), $e);
        }

        return true;
    }

    /**
     * @param array $categoryIds
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(array $categoryIds): bool
    {
        $connection = $this->resourceModel->getConnection();
        try {
            if (isset($categoryIds['selected'])) {
                $connection->delete(ResourceModel::TABLE_NAME, ['id IN (?)' => $categoryIds['selected']]);
            } elseif (($categoryIds['excluded'] !== 'false')) {
                $connection->delete(ResourceModel::TABLE_NAME, ['id NOT IN (?)' => $categoryIds['excluded']]);
            } else {
                $connection->delete($connection->getTableName(ResourceModel::TABLE_NAME));
            }
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__('Could not delete', $e->getMessage()), $e);
        }

        return true;
    }
}
