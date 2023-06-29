<?php declare(strict_types=1);

namespace Tsg\Blog\Api;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Tsg\Blog\Api\Data\BlogTagInterface;

/**
 * Blog tag repository interface.
 * @api
 * @since 1.0.0
 */
interface BlogTagRepositoryInterface
{
    /**
     * @param BlogTagInterface $tag
     * @return BlogTagInterface
     * @throws LocalizedException
     */
    public function addTag(BlogTagInterface $tag): BlogTagInterface;

    /**
     * @param BlogTagInterface $tag
     * @return bool
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteTag(BlogTagInterface $tag): bool;

    /**
     * @return array|null
     */
    public function getCollection(): ?array;
}
