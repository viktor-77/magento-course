<?php declare(strict_types=1);

namespace Umanskiy\Blog\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Message\ManagerInterface;
use Umanskiy\Blog\Api\Data\TagInterface;
use Umanskiy\Blog\Api\TagRepositoryInterface;
use Umanskiy\Blog\Model\ResourceModel\Tag as ResourceModel;
use Umanskiy\Blog\Model\ResourceModel\Tag\CollectionFactory;

class TagRepository implements TagRepositoryInterface
{
    protected CollectionFactory $collectionFactory;
    private TagFactory $tagFactory;
    private ResourceModel $resourceModel;
    private ManagerInterface $messageManager;

    public function __construct(TagFactory $tagFactory, ResourceModel $resourceModel, CollectionFactory $collectionFactory, ManagerInterface $messageManager)
    {
        $this->tagFactory = $tagFactory;
        $this->resourceModel = $resourceModel;
        $this->collectionFactory = $collectionFactory;
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
                $tag = $this->getById($id);
            } else {
                $tag = $this->tagFactory->create();
            }
            $this->resourceModel->save($tag->setTagName($tagName));
        } catch (\Exception $e) {
            if ($e->getMessage() === 'Unique constraint violation found') {
                $this->messageManager->addErrorMessage(__('Tag with the same name already exists.'));

                return false;
            }
            throw new CouldNotSaveException(__('Could not save the category: %1', $e->getMessage()));
        }

        return true;
    }

    /**
     * @param int $tagId
     * @return TagInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $tagId): \Umanskiy\Blog\Api\Data\TagInterface
    {
        try {
            $tag = $this->tagFactory->create()->load($tagId);
        } catch (\Exception $e) {
            throw new NoSuchEntityException(__('Could not save the tag: %1', $e->getMessage()), $e);
        }

        return $tag;
    }

    /**
     * @return array
     * @throws LocalizedException
     */
    public function getList(): array
    {
        try {
            $list = $this->collectionFactory->create()->load()->getData();
        } catch (\Exception $e) {
            throw new LocalizedException(__('Could not save the tag: %1', $e->getMessage()), $e);
        }

        return $list;
    }

    /**
     * @param int $id
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function deleteById(int $id): bool
    {
        try {
            $connection = $this->resourceModel->getConnection();
            $connection->delete(ResourceModel::TABLE_NAME, ["id = $id"]);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__('Could not delete the tag: %1', $id, $e->getMessage()), $e);
        }

        return true;
    }

    /**
     * @param array $tagIds
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(array $tagIds): bool
    {
        $connection = $this->resourceModel->getConnection();
        try {
            if (isset($tagIds['selected'])) {
                $connection->delete(ResourceModel::TABLE_NAME, ['id IN (?)' => $tagIds['selected']]);
            } elseif (($tagIds['excluded'] !== 'false')) {
                $connection->delete(ResourceModel::TABLE_NAME, ['id NOT IN (?)' => $tagIds['excluded']]);
            } else {
                $connection->delete($connection->getTableName(ResourceModel::TABLE_NAME));
            }
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__('Could not delete', $e->getMessage()), $e);
        }

        return true;
    }
}
