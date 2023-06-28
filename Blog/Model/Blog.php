<?php declare(strict_types=1);

namespace Tsg\Blog\Model;

use Magento\Framework\Model\AbstractModel;

class Blog extends AbstractModel
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\Blog::class);
    }
}
