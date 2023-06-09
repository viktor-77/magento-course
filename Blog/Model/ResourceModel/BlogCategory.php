<?php declare(strict_types=1);

namespace Tsg\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Tsg\Blog\Api\Data\BlogCategoryInterface;

class BlogCategory extends AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(BlogCategoryInterface::TABLE_NAME, 'id');
    }
}
