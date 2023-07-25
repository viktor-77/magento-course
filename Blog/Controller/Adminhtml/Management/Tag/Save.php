<?php declare(strict_types=1);

namespace Umanskiy\Blog\Controller\Adminhtml\Management\Tag;

use Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Umanskiy\Blog\Model\TagRepository;

class Save extends Action
{
    protected $resultRedirectFactory;
    private TagRepository $tagRepository;

    /**
     * @param Context $context
     * @param RedirectFactory $resultRedirectFactory
     * @param TagRepository $tagRepository
     */
    public function __construct(
        Context         $context,
        RedirectFactory $resultRedirectFactory,
        TagRepository   $tagRepository
    )
    {
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->tagRepository = $tagRepository;
        parent::__construct($context);
    }

    /**
     * @return Redirect|ResponseInterface|ResultInterface
     * @throws LocalizedException
     */
    public function execute()
    {
        $this->tagRepository->save($this->getRequest()->getParam('tag'));
        return $this->resultRedirectFactory->create()->setPath('blog/management/tag_index');
    }
}

