<?php declare(strict_types=1);

namespace Umanskiy\Blog\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Umanskiy\Blog\Model\TagRepository;

class TagOptions implements OptionSourceInterface
{
    protected TagRepository $tagRepository;

    /**
     * @param TagRepository $tagRepository
     */
    public function __construct(
        TagRepository $tagRepository
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
        foreach ($this->tagRepository->getList() as $option) {
            $optionsArray[] = ['value' => $option['tag'], 'label' => __($option['tag'])];
        }
        return $optionsArray;
    }
}
