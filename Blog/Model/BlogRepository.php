<?php declare(strict_types=1);

namespace Tsg\Blog\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Tsg\Blog\Api\BlogRepositoryInterface;
use Tsg\Blog\Api\Data\BlogInterface;
use Tsg\Blog\Model\ResourceModel\Blog as BlogResourceModel;

class BlogRepository implements BlogRepositoryInterface
{
    private BlogFactory $blogFactory;
    private BlogResourceModel $blogResourceModel;

    /**
     * @param BlogFactory $blogFactory
     * @param BlogResourceModel $blogResourceModel
     */
    public function __construct(BlogFactory $blogFactory, BlogResourceModel $blogResourceModel)
    {
        $this->blogFactory = $blogFactory;
        $this->blogResourceModel = $blogResourceModel;
    }

    /**
     * @param $record
     * @return Blog
     * @throws CouldNotSaveException
     */
    public function addRecord($record): Blog
    {
        try {
            $tags = $record['tags'];
            $record['tags'] = implode(' ', $tags);
            $recordData = $this->blogFactory->create()->setData($record);
            $this->blogResourceModel->save($recordData);
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
            $connection = $this->blogResourceModel->getConnection();
            if (isset($record['selected'])) {
                $connection->delete(BlogInterface::TABLE_NAME, ['id IN (?)' => $record['selected']]);
            } elseif (isset($record['excluded'])) {
                $connection->delete(BlogInterface::TABLE_NAME, ['id NOT IN (?)' => $record['excluded']]);
            } else {
                $connection->delete($connection->getTableName(BlogInterface::TABLE_NAME));
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
