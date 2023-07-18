<?php declare(strict_types=1);

namespace Umanskiy\Blog\Api;

use Umanskiy\Blog\Api\Data\PostInterface;

/**
 * Post CRUD interface.
 */
interface PostRepositoryInterface
{
    /**
     * @param \Umanskiy\Blog\Api\Data\PostInterface $post
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(PostInterface $post): bool;

    /**
     * @param int $postId
     * @return \Umanskiy\Blog\Api\Data\PostInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById(int $postId): \Umanskiy\Blog\Api\Data\PostInterface;

    /**
     * @param array $postList
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(array $postList): bool;

    /**
     * @param int $postId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById(int $postId): bool;
}
