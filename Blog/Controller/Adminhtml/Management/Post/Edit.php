<?php declare(strict_types=1);

namespace Umanskiy\Blog\Controller\Adminhtml\Management\Post;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Message\ManagerInterface;
use Umanskiy\Blog\Model\PostRepository;

class Edit extends Action
{
    protected JsonFactory $resultJsonFactory;
    protected PostRepository $postRepository;

    public function __construct(
        Context          $context,
        JsonFactory      $resultJsonFactory,
        PostRepository   $postRepository,
        ManagerInterface $messageManager
    )
    {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->postRepository = $postRepository;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    public function execute()
    {
        $result = $this->resultJsonFactory->create();

        try {
            $data = $this->getRequest()->getParams();

            if (isset($data['items'])) {
                foreach ($data['items'] as $item) {
                    $this->postRepository->save($item, (int)$item['id']);
                }
            }
            $this->messageManager->addSuccessMessage('Your success message');

            $messages = [];
            foreach ($this->messageManager->getMessages(true)->getItems() as $message) {
                $messages[] = $message->getText();
            }

            return $result->setData(['messages' => $messages]);
        } catch (\Exception $e) {
            return $result->setData([
                'messages' => $e->getMessage(),
                'error' => true
            ]);
        }
    }
}