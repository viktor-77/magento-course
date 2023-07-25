<?php declare(strict_types=1);

namespace Umanskiy\Blog\Controller\Adminhtml\Management\Category;

use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Message\ManagerInterface;
use Umanskiy\Blog\Model\CategoryRepository;
use Umanskiy\Blog\Api\CategoryRepositoryInterface;

class Save extends Action
{
    protected $resultRedirectFactory;
    private CategoryRepository $categoryRepository;

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
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function execute(): \Magento\Backend\Model\View\Result\Redirect
    {
        if ($this->categoryRepository->save($this->getRequest()->getParam('category'))) {
            $successMessage = __('Category with the name: "%1" was successfully saved.', $this->getRequest()->getParam('category'));
            $this->messageManager->addSuccessMessage($successMessage);
        }

        return $this->resultRedirectFactory->create()->setPath('blog/management/category_index');
    }
}
