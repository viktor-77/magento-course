<?php declare(strict_types=1);

namespace Tsg\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Tsg\Blog\Api\Data\BlogTagInterface;

class BlogTag extends AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(BlogTagInterface::TABLE_NAME, 'id');
    }
}
