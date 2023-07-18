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
        return $this->getData(self::ID);
    }

    /**
     * @return string
     */
    public function getTagName(): string
    {
        return $this->getData(self::TAG_NAME);
    }

    /**
     * @param string $tagName
     * @return TagInterface
     */
    public function setTagName(string $tagName): TagInterface
    {
        $this->setData(self::TAG_NAME, $tagName);
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
}
