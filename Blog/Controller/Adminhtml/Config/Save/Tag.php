<?php declare(strict_types=1);

namespace Tsg\Blog\Controller\Adminhtml\Config\Save;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Tsg\Blog\Model\BlogTagRepository;

class Tag extends Action
{
    protected $resultRedirectFactory;
    private BlogTagRepository $blogTagRepository;

    /**
     * @param Context $context
     * @param RedirectFactory $resultRedirectFactory
     * @param BlogTagRepository $blogTagRepository
     */
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

    /**
     * @return Redirect|ResponseInterface|ResultInterface
     * @throws LocalizedException
     */
    public function execute()
    {
        $this->blogTagRepository->addTag($this->getRequest()->getPostValue());

        return $this->resultRedirectFactory->create()->setPath('blog/config/tag');
    }
}
