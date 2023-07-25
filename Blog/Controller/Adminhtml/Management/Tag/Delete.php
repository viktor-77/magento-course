<?php

namespace Umanskiy\Blog\Controller\Adminhtml\Management\Tag;

use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Message\ManagerInterface;
use Umanskiy\Blog\Model\TagRepository;

class Delete extends Action
{
    protected $resultRedirectFactory;
    private TagRepository $blogTagRepository;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory
     * @param \Umanskiy\Blog\Model\TagRepository $blogTagRepository
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     */
    public function __construct(Context $context, RedirectFactory $resultRedirectFactory, TagRepository $blogTagRepository, ManagerInterface $messageManager)
    {
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->blogTagRepository = $blogTagRepository;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function execute()
    {
        $this->blogTagRepository->delete($this->getRequest()->getParams());
        $successMessage = __('Successfully deleted.');
        $this->messageManager->addSuccessMessage($successMessage);

        return $this->resultRedirectFactory->create()->setPath('blog/management/tag_index');
    }
}
