<?php declare(strict_types=1);

namespace Umanskiy\Blog\Controller\Adminhtml\Management\Tag;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Message\ManagerInterface;
use Umanskiy\Blog\Api\TagRepositoryInterface;

class Edit extends Action
{
    protected JsonFactory $resultJsonFactory;
    protected TagRepositoryInterface $tagRepository;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     * @param \Umanskiy\Blog\Api\TagRepositoryInterface $tagRepository
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     */
    public function __construct(Context $context, JsonFactory $resultJsonFactory, TagRepositoryInterface $tagRepository, ManagerInterface $messageManager)
    {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->tagRepository = $tagRepository;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Json|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $result = $this->resultJsonFactory->create();

        try {
            $data = $this->getRequest()->getParams();

            if (isset($data['items'])) {
                foreach ($data['items'] as $item) {
                    if ($this->tagRepository->save($item['name'], (int) $item['id'])) {
                        $this->messageManager->addSuccessMessage('Your success message');
                    }
                }
            }

            $messages = [];
            foreach ($this->messageManager->getMessages(true)->getItems() as $message) {
                $messages[] = $message->getText();
            }

            return $result->setData(['messages' => $messages]);
        } catch (\Exception $e) {
            return $result->setData(['messages' => $e->getMessage(), 'error' => true]);
        }
    }
}
