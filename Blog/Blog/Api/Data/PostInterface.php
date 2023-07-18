<?php declare(strict_types=1);

namespace Umanskiy\Blog\Api\Data;

/**
 * Post DTO interface.
 */
interface PostInterface
{
    public const ID = "id";
    public const THUMBNAIL = 'thumbnail';
    public const TITLE = 'title';
    public const SHORT_TEXT = 'short_text';
    public const TAGS = 'tags';
    public const CATEGORY = 'category';
    public const CREATED_AT = 'created_at';
    public const MODIFIED_AT = 'modified_at';

    /**
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * @return string
     */
    public function getThumbnail(): string;

    /**
     * @param string $thumbnail
     * @return PostInterface
     */
    public function setThumbnail(string $thumbnail): PostInterface;

    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @param string $title
     * @return PostInterface
     */
    public function setTitle(string $title): PostInterface;

    /**
     * @return string
     */
    public function getShortText(): string;

    /**
     * @param string $shortText
     * @return PostInterface
     */
    public function setShortText(string $shortText): PostInterface;

    /**
     * @return string
     */
    public function getTags(): string;

    /**
     * @param string $tags
     * @return PostInterface
     */
    public function setTags(string $tags): PostInterface;

    /**
     * @return string
     */
    public function getCategory(): string;

    /**
     * @param string $category
     * @return PostInterface
     */
    public function setCategory(string $category): PostInterface;

    /**
     * @return string
     */
    public function getCreatedAt(): string;

    /**
     * @return string
     */
    public function getModifiedAT(): string;

    /**
     * @param string $time
     * @return PostInterface
     */
    public function setModifiedAT(string $time): PostInterface;
}
