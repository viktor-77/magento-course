<?php declare(strict_types=1);

namespace Umanskiy\Blog\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Umanskiy\Blog\Api\Data\TagInterface;
use Umanskiy\Blog\Api\TagRepositoryInterface;
use Umanskiy\Blog\Model\ResourceModel\Tag as TagResourceModel;
use Umanskiy\Blog\Model\ResourceModel\Tag\CollectionFactory;

class TagRepository implements TagRepositoryInterface
{
    private TagFactory $tagFactory;
    private TagResourceModel $resourceModel;
    protected CollectionFactory $collectionFactory;

    public function __construct(TagFactory $tagFactory, TagResourceModel $resourceModel, CollectionFactory $collectionFactory)
    {
        $this->tagFactory = $tagFactory;
        $this->resourceModel = $resourceModel;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @param string $tagName
     * @return bool
     * @throws CouldNotSaveException
     */
    public function save(string $tagName): bool
    {
        try {
            $this->resourceModel->save(
                $this->tagFactory->create()->setData(TagInterface::TAG_NAME, $tagName)
            );
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('Could not save the tag: %1', $e->getMessage()), $e);
        }

        return true;
    }

    /**
     * @param int $tagId
     * @return TagInterface
     */
    public function getById(int $tagId): \Umanskiy\Blog\Api\Data\TagInterface
    {
        return $this->tagFactory->create()->load($tagId);
    }

    /**
     * @return array
     */
    public function getList(): array
    {
        return $this->collectionFactory->create()->load()->getData();
    }

    /**
     * @param array $tagIds
     * @return bool
     */
    public function delete(array $tagIds): bool
    {
        foreach ($tagIds as $tagId) {
            $this->deleteById($tagId);
        }
        return true;
    }

    /**
     * @param int $tagId
     * @return bool
     */
    public function deleteById(int $tagId): bool
    {
        try {
            $connection = $this->resourceModel->getConnection();
            $connection->delete(TagResourceModel::TABLE_NAME, ["id = $tagId"]);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__('Could not save the tag: %1', $e->getMessage()), $e);
        }

        return true;
    }
}
