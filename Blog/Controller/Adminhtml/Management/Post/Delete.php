<?php declare(strict_types=1);

namespace Umanskiy\Blog\Controller\Adminhtml\Management\Post;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Message\ManagerInterface;
use Umanskiy\Blog\Api\PostRepositoryInterface;

class Delete extends Action
{
    protected $resultRedirectFactory;
    private PostRepositoryInterface $postRepository;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory
     * @param \Umanskiy\Blog\Api\PostRepositoryInterface $postRepository
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     */
    public function __construct(Context $context, RedirectFactory $resultRedirectFactory, PostRepositoryInterface $postRepository, ManagerInterface $messageManager)
    {
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->postRepository = $postRepository;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function execute(): Redirect
    {
        $this->postRepository->delete($this->getRequest()->getParams());
        $this->messageManager->addSuccessMessage(__('Successfully deleted'));

        return $this->resultRedirectFactory->create()->setPath('blog/management/post_index');
    }
}
