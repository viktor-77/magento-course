<?php declare(strict_types=1);

namespace Tsg\Blog\Api\Data;

/**
 * Blog category DTO interface.
 * @api
 * @since 1.0.0
 */
interface BlogCategoryInterface
{
    const TABLE_NAME = 'blog_category';
    const CATEGORY = 'category';

    /**
     * @return BlogCategoryInterface
     */
    public function getCategory(): BlogCategoryInterface;

    /**
     * @param string $category
     * @return BlogCategoryInterface
     */
    public function setCategory(string $category): BlogCategoryInterface;
}
