<?php declare(strict_types=1);

namespace Umanskiy\Blog\Api\Data;

/**
 * Blog tag DTO interface.
 */
interface TagInterface
{
    public const ID = 'id';
    public const NAME = 'name';
    public const CREATED_AT = 'created_at';
    public const MODIFIED_AT = 'modified_at';

    /**
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * @return string
     */
    public function getTagName(): string;

    /**
     * @param string $tagName
     * @return \Umanskiy\Blog\Api\Data\TagInterface
     */
    public function setTagName(string $tagName): TagInterface;

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
     * @return \Umanskiy\Blog\Api\Data\TagInterface
     */
    public function setModifiedAT(string $time): TagInterface;
}
