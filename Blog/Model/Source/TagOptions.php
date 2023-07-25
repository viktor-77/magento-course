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
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function toOptionArray(): array
    {
        return $this->_getOptions();
    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    private function _getOptions(): array
    {
        $optionsArray = [];
        foreach ($this->tagRepository->getList() as $option) {
            $optionsArray[] = ['value' => $option['id'], 'label' => __($option['name'])];
        }
        return $optionsArray;
    }
}
