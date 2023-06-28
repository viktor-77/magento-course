<?php declare(strict_types=1);

namespace Tsg\Blog\Model;

use Magento\Framework\Exception\CouldNotSaveException;
use Tsg\Blog\Api\BlogCategoryRepositoryInterface;
use Tsg\Blog\Api\Data\BlogCategoryInterface;
use Tsg\Blog\Model\ResourceModel\BlogCategory as categoryResourceModel;

class BlogCategoryRepository implements BlogCategoryRepositoryInterface
{
    private BlogCategoryFactory $blogCategoryFactory;
    private CategoryResourceModel $categoryResourceModel;

    /**
     * @param \Tsg\Blog\Model\BlogCategoryFactory $blogCategoryFactory
     * @param categoryResourceModel $categoryResourceModel
     */
    public function __construct(BlogCategoryFactory $blogCategoryFactory, CategoryResourceModel $categoryResourceModel)
    {
        $this->blogCategoryFactory = $blogCategoryFactory;
        $this->categoryResourceModel = $categoryResourceModel;
    }

    /**
     * @param $category
     * @return BlogCategoryInterface
     * @throws CouldNotSaveException
     */
    public function addCategory($category): BlogCategoryInterface
    {
        try {
            $categoryData = $this->blogCategoryFactory->create();
            $categoryData->setData($category);
            $this->categoryResourceModel->save($categoryData);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('Could not save the category: %1', $e->getMessage()), $e);
        }

        return $categoryData;
    }

    /**
     * @param $category
     * @return bool
     * @throws CouldNotSaveException
     */
    public function deleteCategoryByName($category): bool
    {
        try {
            $connection = $this->categoryResourceModel->getConnection();
            if (isset($category['selected'])) {
                $connection->delete(BlogCategoryInterface::TABLE_NAME, ['category IN (?)' => $category['selected']]);
            } elseif (isset($category['excluded'])) {
                $connection->delete(BlogCategoryInterface::TABLE_NAME, ['category NOT IN (?)' => $category['excluded']]);
            } else {
                $connection->delete($connection->getTableName(BlogCategoryInterface::TABLE_NAME));
            }
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('Could not save the category: %1', $e->getMessage()), $e);
        }

        return true;
    }
}
