<?php declare(strict_types=1);

namespace Tsg\Blog\Model;

use Tsg\Blog\Api\Data\BlogTagInterface;
use Magento\Framework\Model\AbstractModel;

class BlogTag extends AbstractModel implements BlogTagInterface
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\BlogTag::class);
    }

    /**
     * @return $this|BlogTag
     */
    public function getTag(): BlogTagInterface
    {
        $this->getData(self::TAG);
        return $this;

    }

    /**
     * @param string $tag
     * @return $this|BlogTag
     */
    public function setTag(string $tag): BlogTagInterface
    {
        $this->setData(self::TAG, $tag);
        return $this;
    }
}
