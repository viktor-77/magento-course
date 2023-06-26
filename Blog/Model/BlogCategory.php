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
        $this->_init(\Tsg\Blog\Model\ResourceModel\Blog::class);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->getData(self::ID);
    }

    /**
     * @return string
     */
    public function getTag(): string
    {
        return $this->getData(self::TAG);
    }

    /**
     * @param string $tag
     * @return BlogCategoryInterface
     */
    public function setTag(string $tag): BlogCategoryInterface
    {
        return $this->setData(self::TAG, $tag);
    }
}
