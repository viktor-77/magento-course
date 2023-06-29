<?php declare(strict_types=1);

namespace Tsg\Blog\Api\Data;

/**
 * Blog DTO interface.
 * @api
 * @since 1.0.0
 */
interface BlogInterface
{
    const TABLE_NAME = 'blog_details';
    const THUMBNAIL = 'thumbnail';
    const TITLE = 'title';
    const SHORT_TEXT = 'short_text';
    const TAGS = 'tags';
    const CATEGORY = 'category';

    /**
     * @return BlogInterface
     */
    public function getThumbnail(): BlogInterface;

    /**
     * @param string $thumbnail
     * @return BlogInterface
     */
    public function setThumbnail(string $thumbnail): BlogInterface;

    /**
     * @return BlogInterface
     */
    public function getTitle(): BlogInterface;

    /**
     * @param string $title
     * @return BlogInterface
     */
    public function setTitle(string $title): BlogInterface;

    /**
     * @return BlogInterface
     */
    public function getShortText(): BlogInterface;

    /**
     * @param string $shortText
     * @return BlogInterface
     */
    public function setShortText(string $shortText): BlogInterface;

    /**
     * @return BlogInterface
     */
    public function getTags(): BlogInterface;

    /**
     * @param string $tags
     * @return BlogInterface
     */
    public function setTags(string $tags): BlogInterface;

    /**
     * @return BlogInterface
     */
    public function getCategory(): BlogInterface;

    /**
     * @param string $category
     * @return BlogInterface
     */
    public function setCategory(string $category): BlogInterface;
}
