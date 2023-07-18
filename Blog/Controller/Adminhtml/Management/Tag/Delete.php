<?php

namespace Umanskiy\Blog\Controller\Adminhtml\Management\Tag;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
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
    )
    {
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->blogTagRepository = $blogTagRepository;
        parent::__construct($context);
    }

    /**
     * @return Redirect|ResponseInterface|ResultInterface
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function execute()
    {
        $this->blogTagRepository->deleteById((int)$this->getRequest()->getPostValue()['selected'][0]);

        return $this->resultRedirectFactory->create()->setPath('blog/management/tag_index');
    }
}
