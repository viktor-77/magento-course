<?php declare(strict_types=1);

namespace Umanskiy\Blog\Controller\Adminhtml\Management\Category;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Umanskiy\Blog\Model\CategoryRepository;

class Delete extends Action
{
    protected $resultRedirectFactory;
    private CategoryRepository $blogCategoryRepository;

    /**
     * @param Context $context
     * @param RedirectFactory $resultRedirectFactory
     * @param CategoryRepository $blogCategoryRepository
     */
    public function __construct(
        Context            $context,
        RedirectFactory    $resultRedirectFactory,
        CategoryRepository $blogCategoryRepository
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
        $this->blogCategoryRepository->deleteById((int)$this->getRequest()->getPostValue()['selected'][0]);

        return $this->resultRedirectFactory->create()->setPath('blog/management/category_index');
    }
}
