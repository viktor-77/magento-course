<?php declare(strict_types=1);

namespace Umanskiy\Blog\Controller\Adminhtml\Management\Post;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Message\ManagerInterface;
use Umanskiy\Blog\Model\PostRepository;

class Save extends Action
{
    protected $resultRedirectFactory;
    private PostRepository $blogRepository;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory
     * @param \Umanskiy\Blog\Model\PostRepository $blogRepository
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     */
    public function __construct(Context $context, RedirectFactory $resultRedirectFactory, PostRepository $blogRepository, ManagerInterface $messageManager)
    {
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->blogRepository = $blogRepository;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function execute(): Redirect
    {
        $this->blogRepository->save($this->getRequest()->getParams());
        $this->messageManager->addSuccessMessage(__('Post was successfully saved.'));

        return $this->resultRedirectFactory->create()->setPath('blog/management/post_index');
    }
}
