<?php

namespace Umanskiy\Blog\Controller\Adminhtml\Management\Tag;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Umanskiy\Blog\Model\TagRepository;

class Delete extends Action
{
    protected $resultRedirectFactory;
    private TagRepository $blogTagRepository;

    /**
     * @param Context $context
     * @param RedirectFactory $resultRedirectFactory
     * @param TagRepository $blogTagRepository
     */
    public function __construct(
        Context         $context,
        RedirectFactory $resultRedirectFactory,
        TagRepository   $blogTagRepository
    ) {
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->blogTagRepository = $blogTagRepository;
        parent::__construct($context);
    }

    /**
     * @return Redirect|ResponseInterface|ResultInterface
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function execute()
    {
        $this->blogTagRepository->delete($this->getRequest()->getParams());

        return $this->resultRedirectFactory->create()->setPath('blog/management/tag_index');
    }
}
