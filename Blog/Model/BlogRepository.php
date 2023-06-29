<?php declare(strict_types=1);

namespace Tsg\Blog\Model;

use Magento\Framework\Exception\CouldNotSaveException;
use Tsg\Blog\Api\BlogRepositoryInterface;
use Tsg\Blog\Api\Data\BlogInterface;
use Tsg\Blog\Model\ResourceModel\Blog as BlogResourceModel;
use Tsg\Blog\Model\BlogFactory;

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
}
