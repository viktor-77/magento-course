<?php declare(strict_types=1);

namespace Umanskiy\Blog\Controller\Adminhtml\Management\Category;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Message\ManagerInterface;
use Umanskiy\Blog\Model\CategoryRepository;

class Delete extends Action
{
    protected $resultRedirectFactory;
    private CategoryRepository $blogCategoryRepository;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory
     * @param \Umanskiy\Blog\Model\CategoryRepository $blogCategoryRepository
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     */
    public function __construct(Context $context, RedirectFactory $resultRedirectFactory, CategoryRepository $blogCategoryRepository, ManagerInterface $messageManager)
    {
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->blogCategoryRepository = $blogCategoryRepository;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function execute(): Redirect
    {
        $this->blogCategoryRepository->delete($this->getRequest()->getParams());
        $successMessage = __('Successfully deleted.');
        $this->messageManager->addSuccessMessage($successMessage);

        return $this->resultRedirectFactory->create()->setPath('blog/management/category_index');
    }
}
