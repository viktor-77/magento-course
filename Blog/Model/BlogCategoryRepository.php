<?php declare(strict_types=1);

namespace Tsg\Blog\Model;

use Magento\Framework\Exception\NoSuchEntityException;
use Tsg\Blog\Api\BlogCategoryRepositoryInterface;
use Tsg\Blog\Model\ResourceModel\BlogCategory as categoryResourceModel;
use Tsg\Blog\Model\BlogCategory;

class BlogCategoryRepository implements BlogCategoryRepositoryInterface
{
    private BlogCategoryFactory $blogCategoryFactory;
    private CategoryResourceModel $categoryResourceModel;

    public function __construct(BlogCategoryFactory $blogCategoryFactory, CategoryResourceModel $categoryResourceModel)
    {
        $this->blogCategoryFactory = $blogCategoryFactory;
        $this->categoryResourceModel = $categoryResourceModel;
    }

    public function getTagById(int $id)
    {
        $category = $this->BlogCategoryFactory->create();
        $this->categoryResourceModel->load($category, $id);

        if (!$category->getId()) {
            throw new NoSuchEntityException(__("The Category with ID = $id doesn't exist"));
        }

        return $category;
    }

    public function saveNewTag(BlogCategoryInterface $tag)
    {
    }

//    public function deleteTagById(BlogCategoryInterface $tag): bool
//    {
//    }
}
