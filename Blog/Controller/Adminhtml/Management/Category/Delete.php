<?php declare(strict_types=1);

namespace Umanskiy\Blog\Controller\Adminhtml\Management\Category;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Message\ManagerInterface;
use Umanskiy\Blog\Api\CategoryRepositoryInterface;

class Delete extends Action
{
    protected $resultRedirectFactory;
    private CategoryRepositoryInterface $categoryRepository;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory
     * @param \Umanskiy\Blog\Api\CategoryRepositoryInterface $categoryRepository
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     */
    public function __construct(Context $context, RedirectFactory $resultRedirectFactory, CategoryRepositoryInterface $categoryRepository, ManagerInterface $messageManager)
    {
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->categoryRepository = $categoryRepository;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function execute(): Redirect
    {
        $this->categoryRepository->delete($this->getRequest()->getParams());
        $successMessage = __('Successfully deleted.');
        $this->messageManager->addSuccessMessage($successMessage);

        return $this->resultRedirectFactory->create()->setPath('blog/management/category_index');
    }
}
