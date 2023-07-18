<?php declare(strict_types=1);

namespace Umanskiy\Blog\Model;

use Magento\Framework\Exception\CouldNotSaveException;
use Umanskiy\Blog\Api\Data\PostInterface;
use Umanskiy\Blog\Api\PostRepositoryInterface;
use Umanskiy\Blog\Model\PostFactory;
use Umanskiy\Blog\Model\ResourceModel\Post as PostResourceModel;

class PostRepository //implements RepositoryInterface
{
    private PostFactory $postFactory;
    private PostResourceModel $postResourceModel;

    /**
     * @param \Umanskiy\Blog\Model\PostFactory $postFactory
     * @param PostResourceModel $postResourceModel
     */
    public function __construct(PostFactory $postFactory, PostResourceModel $postResourceModel)
    {
        $this->postFactory = $postFactory;
        $this->postResourceModel = $postResourceModel;
    }

    /**
     * @param $record
     * @return Post
     * @throws CouldNotSaveException
     */
    public function addRecord($record): Post
    {
        try {
            $tags = $record['tags'];
            $record['tags'] = implode(' ', $tags);
            $recordData = $this->postFactory->create()->setData($record);
            $this->postResourceModel->save($recordData);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('Could not save the tag: %1', $e->getMessage()), $e);
        }

        return $recordData;
    }

    /**
     * @param $record
     * @return bool
     * @throws CouldNotSaveException
     */
    public function deleteRecord($record): bool
    {
        try {
            $connection = $this->postResourceModel->getConnection();
            if (isset($record['selected'])) {
                $connection->delete(PostResourceModel::TABLE_NAME, ['id IN (?)' => $record['selected']]);
            } elseif (isset($record['excluded'])) {
                $connection->delete(PostResourceModel::TABLE_NAME, ['id NOT IN (?)' => $record['excluded']]);
            } else {
                $connection->delete($connection->getTableName(PostResourceModel::TABLE_NAME));
            }
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('Could not save the tag: %1', $e->getMessage()), $e);
        }

        return true;
    }

//    /**
//     * @param $id
//     * @return BlogInterface
//     * @throws NoSuchEntityException
//     */
//    public function getById($id): BlogInterface
//    {
//        $blog = $this->blogFactory->create();
//        $this->blogResourceModel->load($blog, $id);
//
//        if (!$blog->getId()) {
//            throw new NoSuchEntityException(__('Blog with id =: %1 does not exist', $id));
//        }
//        return $blog;
//    }
//
//    /**
//     * @param $id
//     * @return bool
//     * @throws CouldNotDeleteException
//     * @throws NoSuchEntityException
//     */
//    public function deleteById($id): bool
//    {
//        $blog = $this->getById($id);
//        try {
//            $this->blogResourceModel->delete($blog);
//        } catch (\Exception $e) {
//            throw new CouldNotDeleteException(__($e->getMessage()));
//        }
//        return true;
//    }
//
//    /**
//     * @return bool
//     * @throws CouldNotDeleteException
//     */
//    public function deleteAll(): bool
//    {
//        $connection = $this->blogResourceModel->getConnection();
//        try {
//            $connection->delete($connection->getTableName(BlogInterface::TABLE_NAME));
//        } catch (\Exception $e) {
//            throw new CouldNotDeleteException(__($e->getMessage()));
//        }
//        return true;
//    }
}
