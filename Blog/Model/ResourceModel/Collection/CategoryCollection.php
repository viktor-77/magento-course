<?php declare(strict_types=1);

namespace Tsg\Blog\Model\ResourceModel\Collection;

use Tsg\Blog\Model\BlogCategory;
use Tsg\Blog\Model\ResourceModel\BlogCategory as CategoryResource;

class CategoryCollection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(BlogCategory::class, CategoryResource::class);
    }

}