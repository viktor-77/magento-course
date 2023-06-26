<?php declare(strict_types=1);

namespace Tsg\Blog\Api\Data;

/**
 * Blog category DTO interface.
 * @api
 * @since 1.0.0
 */
interface BlogCategoryInterface
{
    const CATEGORY = 'category';

    /**
     * @return $this
     */
    public function getCategory();

    /**
     * @param string $category
     * @return $this
     */
    public function setCategory(string $category);
}
