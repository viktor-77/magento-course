<?php declare(strict_types=1);

namespace Umanskiy\Blog\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Umanskiy\Blog\Api\Data\PostInterface;
use Umanskiy\Blog\Api\PostRepositoryInterface;
use Umanskiy\Blog\Model\ResourceModel\Post as ResourceModel;

class PostRepository implements PostRepositoryInterface
{
    private PostFactory $postFactory;
    private ResourceModel $resourceModel;

    /**
     * @param \Umanskiy\Blog\Model\PostFactory $postFactory
     * @param \Umanskiy\Blog\Model\ResourceModel\Post $resourceModel
     */
    public function __construct(PostFactory $postFactory, ResourceModel $resourceModel)
    {
        $this->postFactory = $postFactory;
        $this->resourceModel = $resourceModel;
    }

    /**
     * @param array $postData
     * @param int|null $id
     * @return bool
     * @throws CouldNotSaveException
     */
    public function save(array $postData, ?int $id = NULL): bool
    {
        try {
            if ($id) {
                $post = $this->getById($id);
            }
            else {
                $postData['tag_ids'] = is_array($postData['tag_ids']) ? implode(';', $postData['tag_ids']) : $postData['tag_ids'];
                $post = $this->postFactory->create();
            }
            $this->resourceModel->save($post->setData($postData));
        } catch(\Exception $e) {
            throw new CouldNotSaveException(__('Could not save the category: %1', $e->getMessage()));
        }

        return true;
    }

    /**
     * @param array $postIds
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(array $postIds): bool
    {
        $connection = $this->resourceModel->getConnection();
        try {
            if (isset($postIds['selected'])) {
                $connection->delete(ResourceModel::TABLE_NAME, ['id IN (?)' => $postIds['selected']]);
            }
            elseif (($postIds['excluded'] !== 'false')) {
                $connection->delete(ResourceModel::TABLE_NAME, ['id NOT IN (?)' => $postIds['excluded']]);
            }
            else {
                $connection->delete($connection->getTableName(ResourceModel::TABLE_NAME));
            }
        } catch(\Exception $e) {
            throw new CouldNotDeleteException(__('Could not delete', $e->getMessage()), $e);
        }

        return true;
    }

    /**
     * @param $id
     * @return PostInterface
     * @throws NoSuchEntityException
     */
    public function getById($id): PostInterface
    {
        $blog = $this->postFactory->create();
        $this->resourceModel->load($blog, $id);

        if (!$blog->getId()) {
            throw new NoSuchEntityException(__('Blog with id =: %1 does not exist', $id));
        }

        return $blog;
    }

    /**
     * @param $id
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($id): bool
    {
        $blog = $this->getById($id);
        try {
            $this->resourceModel->delete($blog);
        } catch(\Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()));
        }

        return true;
    }
}
