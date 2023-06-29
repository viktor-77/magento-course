<?php declare(strict_types=1);

namespace Tsg\Blog\Model;

use Magento\Framework\Model\AbstractModel;
use Tsg\Blog\Api\Data\BlogInterface;

class Blog extends AbstractModel implements BlogInterface
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\Blog::class);
    }

    public function getThumbnail(): BlogInterface
    {
        $this->getData(self::THUMBNAIL);
        return $this;
    }

    public function setThumbnail(string $thumbnail): BlogInterface
    {
        $this->setData(self::THUMBNAIL, $thumbnail);
        return $this;
    }

    public function getTitle(): BlogInterface
    {
        $this->getData(self::TITLE);
        return $this;
    }

    public function setTitle(string $title): BlogInterface
    {
        $this->setData(self::TITLE, $title);
        return $this;
    }

    public function getShortText(): BlogInterface
    {
        $this->getData(self::SHORT_TEXT);
        return $this;
    }

    public function setShortText(string $shortText): BlogInterface
    {
        $this->setData(self::SHORT_TEXT, $shortText);
        return $this;
    }

    public function getTags(): BlogInterface
    {
        $this->getData(self::TAGS);
        return $this;
    }

    public function setTags(string $tags): BlogInterface
    {
        $this->setData(self::TAGS, $tags);
        return $this;
    }

    public function getCategory(): BlogInterface
    {
        $this->getData(self::CATEGORY);
        return $this;
    }

    public function setCategory(string $category): BlogInterface
    {
        $this->setData(self::CATEGORY, $category);
        return $this;
    }
}
