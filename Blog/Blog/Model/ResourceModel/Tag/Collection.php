<?php declare(strict_types=1);

namespace Umanskiy\Blog\Model\ResourceModel\Tag;

use Umanskiy\Blog\Model\ResourceModel\Tag as TagResource;
use Umanskiy\Blog\Model\Tag;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Tag::class, TagResource::class);
    }

}