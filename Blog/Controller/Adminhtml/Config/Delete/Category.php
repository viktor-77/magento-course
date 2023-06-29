<?php declare(strict_types=1);

namespace Tsg\Blog\Controller\Adminhtml\Config\Delete;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Tsg\Blog\Model\BlogCategoryRepository;

class Category extends Action
{
    protected $resultRedirectFactory;
    private BlogCategoryRepository $blogCategoryRepository;

    /**
     * @param Context $context
     * @param RedirectFactory $resultRedirectFactory
     * @param BlogCategoryRepository $blogCategoryRepository
     */
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

    /**
     * @return Redirect|ResponseInterface|ResultInterface
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function execute()
    {
        $this->blogCategoryRepository->deleteCategory($this->getRequest()->getPostValue());

        return $this->resultRedirectFactory->create()->setPath('blog/config/category');
    }
}
