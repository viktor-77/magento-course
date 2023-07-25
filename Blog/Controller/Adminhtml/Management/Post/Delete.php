<?php

namespace Umanskiy\Blog\Controller\Adminhtml\Management\Post;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Umanskiy\Blog\Model\PostRepository;

class Delete extends Action
{
    protected $resultRedirectFactory;
    private PostRepository $postRepository;

    /**
     * @param Context $context
     * @param RedirectFactory $resultRedirectFactory
     * @param PostRepository $postRepository
     */
    public function __construct(
        Context         $context,
        RedirectFactory $resultRedirectFactory,
        PostRepository  $postRepository
    ) {
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->postRepository = $postRepository;
        parent::__construct($context);
    }

    /**
     * @return Redirect
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function execute()
    {
        $this->postRepository->delete($this->getRequest()->getParams());

        return $this->resultRedirectFactory->create()->setPath('blog/management/post_index');
    }
}
