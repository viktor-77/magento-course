<?php declare(strict_types=1);

namespace Umanskiy\Blog\Model;

use Magento\Framework\Model\AbstractModel;
use Umanskiy\Blog\Api\Data\PostInterface;

class Post extends AbstractModel implements PostInterface
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\Post::class);
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
    public function getThumbnail(): string
    {
        return $this->getData(self::THUMBNAIL);
    }

    /**
     * @param string $thumbnail
     * @return PostInterface
     */
    public function setThumbnail(string $thumbnail): PostInterface
    {
        $this->setData(self::THUMBNAIL, $thumbnail);
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->getData(self::TITLE);
    }

    /**
     * @param string $title
     * @return PostInterface
     */
    public function setTitle(string $title): PostInterface
    {
        $this->setData(self::TITLE, $title);
        return $this;
    }

    /**
     * @return string
     */
    public function getShortText(): string
    {
        return $this->getData(self::SHORT_TEXT);
    }

    /**
     * @param string $shortText
     * @return PostInterface
     */
    public function setShortText(string $shortText): PostInterface
    {
        $this->setData(self::SHORT_TEXT, $shortText);
        return $this;
    }

    /**
     * @return string
     */
    public function getTags(): string
    {
        return $this->getData(self::TAGS);
    }

    /**
     * @param string $tags
     * @return PostInterface
     */
    public function setTags(string $tags): PostInterface
    {
        $this->setData(self::TAGS, $tags);
        return $this;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->getData(self::CATEGORY);
    }

    /**
     * @param string $category
     * @return PostInterface
     */
    public function setCategory(string $category): PostInterface
    {
        $this->setData(self::CATEGORY, $category);
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
     * @return PostInterface
     */
    public function setModifiedAT(string $time): PostInterface
    {
        $this->setData(self::MODIFIED_AT, $time);
        return $this;
    }
}
