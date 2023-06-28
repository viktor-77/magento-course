<?php declare(strict_types=1);

namespace Tsg\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;


class Blog extends AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('blog_details', 'id');
    }
}
