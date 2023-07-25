<?php declare(strict_types=1);

namespace Umanskiy\Blog\Controller\Adminhtml\Management\Tag;

use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Message\ManagerInterface;
use Umanskiy\Blog\Api\TagRepositoryInterface;

class Delete extends Action
{
    protected $resultRedirectFactory;
    private TagRepositoryInterface $tagRepository;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory
     * @param \Umanskiy\Blog\Api\TagRepositoryInterface $tagRepository
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     */
    public function __construct(Context $context, RedirectFactory $resultRedirectFactory, TagRepositoryInterface $tagRepository, ManagerInterface $messageManager)
    {
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->tagRepository = $tagRepository;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function execute()
    {
        $this->tagRepository->delete($this->getRequest()->getParams());
        $successMessage = __('Successfully deleted.');
        $this->messageManager->addSuccessMessage($successMessage);

        return $this->resultRedirectFactory->create()->setPath('blog/management/tag_index');
    }
}
