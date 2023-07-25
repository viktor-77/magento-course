<?php declare(strict_types=1);

namespace Umanskiy\Blog\Model;

use Magento\Framework\Model\AbstractModel;
use Umanskiy\Blog\Api\Data\TagInterface;

class Tag extends AbstractModel implements TagInterface
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\Tag::class);
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
    public function getTagName(): string
    {
        return $this->getData(self::NAME);
    }

    /**
     * @param string $tagName
     * @return TagInterface
     */
    public function setTagName(string $tagName): TagInterface
    {
        $this->setData(self::NAME, $tagName);
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
     * @return TagInterface
     */
    public function setModifiedAT(string $time): TagInterface
    {
        $this->setData(self::MODIFIED_AT, $time);
        return $this;
    }

    /**
     * @return Tag
     */
    public function beforeSave(): Tag
    {
        $this->setModifiedAt(date('Y-m-d H:i:s'));
        return parent::beforeSave();
    }
}
