<?php declare(strict_types=1);

namespace Tsg\Blog\Api\Data;

/**
 * Blog tag DTO interface.
 * @api
 * @since 1.0.0
 */
interface BlogTagInterface
{
    const TABLE_NAME = 'blog_tag';
    const TAG = 'tag';

    /**
     * @return BlogTagInterface
     */
    public function getTag(): BlogTagInterface;

    /**
     * @param string $tag
     * @return BlogTagInterface
     */
    public function setTag(string $tag): BlogTagInterface;
}
