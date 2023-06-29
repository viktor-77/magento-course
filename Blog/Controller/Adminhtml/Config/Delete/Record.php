<?php

namespace Tsg\Blog\Controller\Adminhtml\Config\Delete;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Tsg\Blog\Model\BlogRepository;

class Record extends Action
{
    protected $resultRedirectFactory;
    private BlogRepository $blogRepository;

    /**
     * @param Context $context
     * @param RedirectFactory $resultRedirectFactory
     * @param BlogRepository $blogRepository
     */
    public function __construct(
        Context         $context,
        RedirectFactory $resultRedirectFactory,
        BlogRepository  $blogRepository
    )
    {
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->blogRepository = $blogRepository;
        parent::__construct($context);
    }

    /**
     * @return Redirect|ResponseInterface|ResultInterface
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function execute()
    {
        $this->blogRepository->deleteRecord($this->getRequest()->getPostValue());

        return $this->resultRedirectFactory->create()->setPath('blog/config/record');
    }
}
