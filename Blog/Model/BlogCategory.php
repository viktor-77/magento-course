<?php declare(strict_types=1);

namespace Tsg\Blog\Model;

use Tsg\Blog\Api\Data\BlogCategoryInterface;

class BlogCategory extends \Magento\Framework\Model\AbstractModel implements BlogCategoryInterface
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Tsg\Blog\Model\ResourceModel\BlogCategory::class);
    }

    public function getCategory()
    {
        $this->getData(self::CATEGORY);
        return $this;

    }

    public function setCategory(string $category)
    {
        $this->setData(self::CATEGORY, $category);
        return $this;
    }
}
