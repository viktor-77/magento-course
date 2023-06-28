<?php declare(strict_types=1);

namespace Tsg\Blog\Model;

use Tsg\Blog\Api\Data\BlogCategoryInterface;
use Magento\Framework\Model\AbstractModel;

class BlogCategory extends AbstractModel implements BlogCategoryInterface
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\BlogCategory::class);
    }

    /**
     * @return $this|BlogCategory
     */
    public function getCategory()
    {
        $this->getData(self::CATEGORY);
        return $this;

    }

    /**
     * @param string $category
     * @return $this|BlogCategory
     */
    public function setCategory(string $category)
    {
        $this->setData(self::CATEGORY, $category);
        return $this;
    }
}
