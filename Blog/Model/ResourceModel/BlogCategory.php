<?php declare(strict_types=1);

namespace Tsg\Blog\Model\ResourceModel;

class BlogCategory extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('blog_category', 'id');
    }
}
