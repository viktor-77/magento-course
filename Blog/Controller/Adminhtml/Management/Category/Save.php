<?php declare(strict_types=1);

namespace Umanskiy\Blog\Controller\Adminhtml\Management\Category;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Umanskiy\Blog\Model\CategoryRepository;

class Save extends Action
{
    protected $resultRedirectFactory;
    private CategoryRepository $categoryRepository;

    /**
     * @param Context $context
     * @param RedirectFactory $resultRedirectFactory
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(
        Context            $context,
        RedirectFactory    $resultRedirectFactory,
        CategoryRepository $categoryRepository
    )
    {
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->categoryRepository = $categoryRepository;
        parent::__construct($context);
    }

    /**
     * @return Redirect|ResponseInterface|ResultInterface
     * @throws LocalizedException
     */
    public function execute()
    {
        $this->categoryRepository->save($this->getRequest()->getParam('category'));

        return $this->resultRedirectFactory->create()->setPath('blog/management/category_index');
    }
}
