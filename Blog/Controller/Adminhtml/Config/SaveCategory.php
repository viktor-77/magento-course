<?php

namespace Tsg\Blog\Controller\Adminhtml\Config;

use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Tsg\Blog\Model\BlogCategoryRepository;

class SaveCategory extends Action
{
    protected $resultRedirectFactory;
    private BlogCategoryRepository $blogCategoryRepository;

    public function __construct(
        Context                $context,
        RedirectFactory        $resultRedirectFactory,
        BlogCategoryRepository $blogCategoryRepository
    )
    {
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->blogCategoryRepository = $blogCategoryRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        $categoryData = $this->getRequest()->getPostValue();
        $this->blogCategoryRepository->addCategory($categoryData);

        return $this->resultRedirectFactory->create()->setPath('blog/config/category');
    }
}
