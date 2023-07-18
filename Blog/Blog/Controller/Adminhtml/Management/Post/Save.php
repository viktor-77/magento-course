<?php declare(strict_types=1);

namespace Umanskiy\Blog\Controller\Adminhtml\Management\Post;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Umanskiy\Blog\Model\PostRepository;

class Save extends Action
{
    protected $resultRedirectFactory;
    private PostRepository $blogRepository;

    /**
     * @param Context $context
     * @param RedirectFactory $resultRedirectFactory
     * @param PostRepository $blogRepository
     */
    public function __construct(
        Context         $context,
        RedirectFactory $resultRedirectFactory,
        PostRepository  $blogRepository
    )
    {
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->blogRepository = $blogRepository;
        parent::__construct($context);
    }

    /**
     * @return Redirect
     * @throws LocalizedException
     */
    public function execute()
    {
        $this->blogRepository->addRecord($this->getRequest()->getPostValue());

        return $this->resultRedirectFactory->create()->setPath('blog/management/post/index');
    }
}
