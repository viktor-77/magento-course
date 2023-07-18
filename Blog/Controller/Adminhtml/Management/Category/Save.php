<?php declare(strict_types=1);

namespace Umanskiy\Blog\Controller\Adminhtml\Management\Category;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Umanskiy\Blog\Model\CategoryFactory;
use Umanskiy\Blog\Model\CategoryRepository;

class Save extends Action
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
        CategoryRepository $blogCategoryRepository,
        CategoryFactory    $blogCategoryFactory
    )
    {
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->blogCategoryRepository = $blogCategoryRepository;
        $this->blogCategoryFactory = $blogCategoryFactory;
        parent::__construct($context);
    }

    /**
     * @return Redirect|ResponseInterface|ResultInterface
     * @throws LocalizedException
     */
    public function execute()
    {
        $this->blogCategoryRepository->save($this->getRequest()->getPostValue()['category_name']);

        return $this->resultRedirectFactory->create()->setPath('blog/management/category_index');
    }
}
