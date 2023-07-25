<?php declare(strict_types=1);

namespace Umanskiy\Blog\Controller\Adminhtml\Management\Category;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Message\ManagerInterface;
use Umanskiy\Blog\Model\CategoryRepository;

class Edit extends Action
{
    protected JsonFactory $resultJsonFactory;
    protected CategoryRepository $categoryRepository;

    public function __construct(
        Context            $context,
        JsonFactory        $resultJsonFactory,
        CategoryRepository $categoryRepository,
        ManagerInterface   $messageManager
    )
    {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->categoryRepository = $categoryRepository;
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
                    $this->categoryRepository->save($item['name'], (int)$item['id']);
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
