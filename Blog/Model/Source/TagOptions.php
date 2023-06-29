<?php declare(strict_types=1);

namespace Tsg\Blog\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Tsg\Blog\Model\BlogTagRepository;

class TagOptions implements OptionSourceInterface
{
    protected BlogTagRepository $tagRepository;

    /**
     * @param BlogTagRepository $tagRepository
     */
    public function __construct(
        BlogTagRepository $tagRepository
    )
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * @return array
     */
    public function toOptionArray(): array
    {
        return $this->_getOptions();
    }

    /**
     * @return array
     */
    private function _getOptions(): array
    {
        $optionsArray = [];
        foreach ($this->tagRepository->getCollection() as $option) {
            $optionsArray[] = ['value' => $option['tag'], 'label' => __($option['tag'])];
        }
        return $optionsArray;
    }
}
