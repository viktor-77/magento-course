<?php declare(strict_types=1);

namespace Tsg\Blog\Model;

use Magento\Framework\Exception\CouldNotSaveException;
use Tsg\Blog\Api\BlogTagRepositoryInterface;
use Tsg\Blog\Api\Data\BlogTagInterface;
use Tsg\Blog\Model\ResourceModel\BlogTag as TagResourceModel;
use Tsg\Blog\Model\ResourceModel\Collection\TagCollectionFactory;


class BlogTagRepository implements BlogTagRepositoryInterface
{
    private BlogTagFactory $blogTagFactory;
    private TagResourceModel $tagResourceModel;
    protected TagCollectionFactory $collectionFactory;


    /**
     * @param BlogTagFactory $blogTagFactory
     * @param TagResourceModel $tagResourceModel
     */
    public function __construct(BlogTagFactory $blogTagFactory, TagResourceModel $tagResourceModel, TagCollectionFactory $collectionFactory)
    {
        $this->blogTagFactory = $blogTagFactory;
        $this->tagResourceModel = $tagResourceModel;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @param $tag
     * @return BlogTagInterface
     * @throws CouldNotSaveException
     */
    public function addTag($tag): BlogTagInterface
    {
        try {
            $tagData = $this->blogTagFactory->create();
            $tagData->setData($tag);
            $this->tagResourceModel->save($tagData);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('Could not save the tag: %1', $e->getMessage()), $e);
        }

        return $tagData;
    }

    /**
     * @param $tag
     * @return bool
     * @throws CouldNotSaveException
     */
    public function deleteTag($tag): bool
    {
        try {
            $connection = $this->tagResourceModel->getConnection();
            if (isset($tag['selected'])) {
                $connection->delete(BlogTagInterface::TABLE_NAME, ['tag IN (?)' => $tag['selected']]);
            } elseif (isset($tag['excluded'])) {
                $connection->delete(BlogTagInterface::TABLE_NAME, ['tag NOT IN (?)' => $tag['excluded']]);
            } else {
                $connection->delete($connection->getTableName(BlogTagInterface::TABLE_NAME));
            }
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('Could not save the tag: %1', $e->getMessage()), $e);
        }

        return true;
    }

    /**
     * @return array|null
     */
    public function getCollection(): ?array
    {
        return $this->collectionFactory->create()->load()->getData();
    }
}
