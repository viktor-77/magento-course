<?php

namespace Tsg\Blog\Controller\Adminhtml\Config;

use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class SaveRecord extends Action
{
    protected $resultRedirectFactory;

    public function __construct(
        Context         $context,
        RedirectFactory $resultRedirectFactory
    )
    {
        $this->resultRedirectFactory = $resultRedirectFactory;
        parent::__construct($context);
    }

    public function execute()
    {
//        $recordData = $this->getRequest()->getPostValue();
//        $this->blogCategoryRepository->saveNewTag($recordData);

        return $this->resultRedirectFactory->create()->setPath('blog/config/record');
    }
}
