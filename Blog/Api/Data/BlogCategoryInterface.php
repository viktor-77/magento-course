<?php declare(strict_types=1);

namespace Tsg\Blog\Api\Data;

/**
 * Blog category DTO interface.
 * @api
 * @since 1.0.0
 */
interface BlogCategoryInterface
{
    const ID = 'id';
    const TAG = 'tag';

    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getTag(): string;

    /**
     * @param string $tag
     * @return self
     */
    public function setTag(string $tag): self;
}
