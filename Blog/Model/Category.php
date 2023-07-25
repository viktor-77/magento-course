<?php declare(strict_types=1);

namespace Umanskiy\Blog\Model;

use Magento\Framework\Model\AbstractModel;
use Umanskiy\Blog\Api\Data\CategoryInterface;

class Category extends AbstractModel implements CategoryInterface
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\Category::class);
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return is_null($this->getData(self::ID)) ?
            null : (int)$this->getData(self::ID);
    }

    /**
     * @return string
     */
    public function getCategoryName(): string
    {
        return $this->getData(self::NAME);
    }

    /**
     * @param string $categoryName
     * @return CategoryInterface
     */
    public function setCategoryName(string $categoryName): CategoryInterface
    {
        $this->setData(self::NAME, $categoryName);
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @return string
     */
    public function getModifiedAT(): string
    {
        return $this->getData(self::MODIFIED_AT);
    }

    /**
     * @param string $time
     * @return CategoryInterface
     */
    public function setModifiedAT(string $time): CategoryInterface
    {
        $this->setData(self::MODIFIED_AT, $time);
        return $this;
    }

    public function beforeSave()
    {
        $this->setModifiedAt(date('Y-m-d H:i:s'));
        return parent::beforeSave();
    }
}
