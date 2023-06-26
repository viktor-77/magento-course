<?php

namespace Tsg\Blog\Controller\Adminhtml\Config;

use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Tsg\Blog\Model\BlogTagRepository;

class SaveTag extends Action
{
    protected $resultRedirectFactory;
    private BlogTagRepository $blogTagRepository;

    public function __construct(
        Context           $context,
        RedirectFactory   $resultRedirectFactory,
        BlogTagRepository $blogTagRepository
    )
    {
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->blogTagRepository = $blogTagRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        $tagData = $this->getRequest()->getPostValue();
        $this->blogTagRepository->saveNewTag($tagData);

        return $this->resultRedirectFactory->create()->setPath('blog/config/tag');
    }
}
