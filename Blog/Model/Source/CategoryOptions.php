<?php declare(strict_types=1);

namespace Tsg\Blog\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Tsg\Blog\Model\BlogCategoryRepository;

class CategoryOptions implements OptionSourceInterface
{
    protected BlogCategoryRepository $categoryRepository;

    /**
     * @param BlogCategoryRepository $categoryRepository
     */
    public function __construct(
        BlogCategoryRepository $categoryRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
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
        foreach ($this->categoryRepository->getCollection() as $option) {
            $optionsArray[] = ['value' => $option['category'], 'label' => __($option['category'])];
        }
        return $optionsArray;
    }
}
