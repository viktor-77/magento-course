<?php declare(strict_types=1);

namespace Tsg\Blog\Model;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Tsg\Blog\Api\BlogCategoryRepositoryInterface;
use Tsg\Blog\Api\Data\BlogCategoryInterface;
use Tsg\Blog\Model\ResourceModel\BlogCategory as categoryResourceModel;

class BlogCategoryRepository implements BlogCategoryRepositoryInterface
{
    private BlogCategoryFactory $blogCategoryFactory;
    private CategoryResourceModel $categoryResourceModel;

    public function __construct(BlogCategoryFactory $blogCategoryFactory, CategoryResourceModel $categoryResourceModel)
    {
        $this->blogCategoryFactory = $blogCategoryFactory;
        $this->categoryResourceModel = $categoryResourceModel;
    }

    public function getCategoryByName(string $category): BlogCategoryInterface
    {
        $categoryModel = $this->BlogCategoryFactory->create();
        $this->categoryResourceModel->load($categoryModel, $category);

        if (!$categoryModel->getCategory()) {
            throw new NoSuchEntityException(__("The Category with category = $category doesn't exist"));
        }

        return $category;
    }

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
}
