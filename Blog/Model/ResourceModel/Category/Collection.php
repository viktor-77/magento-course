<?php declare(strict_types=1);

namespace Umanskiy\Blog\Model\ResourceModel\Category;

use Umanskiy\Blog\Model\Category;
use Umanskiy\Blog\Model\ResourceModel\Category as CategoryResource;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Category::class, CategoryResource::class);
    }

}