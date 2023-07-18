<?php declare(strict_types=1);

namespace Umanskiy\Blog\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Umanskiy\Blog\Model\CategoryRepository;

class CategoryOptions implements OptionSourceInterface
{
    protected CategoryRepository $categoryRepository;

    /**
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(
        CategoryRepository $categoryRepository
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
        foreach ($this->categoryRepository->getList() as $option) {
            $optionsArray[] = ['value' => $option['category'], 'label' => __($option['category'])];
        }
        return $optionsArray;
    }
}
