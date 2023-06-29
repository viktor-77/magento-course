<?php declare(strict_types=1);

namespace Tsg\Blog\Model\ResourceModel\Collection;

use Tsg\Blog\Model\BlogTag;
use Tsg\Blog\Model\ResourceModel\BlogTag as TagResource;

class TagCollection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(BlogTag::class, TagResource::class);
    }

}