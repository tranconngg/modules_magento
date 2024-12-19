<?php
namespace WeatherApi\Module\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Post extends Action
{
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    public function execute()
    {
        $post = (array) $this->getRequest()->getPost();

        if (!empty($post)) {
            $city = $post['city'];
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setPath('weather/index/index', ['city' => $city]);
            return $resultRedirect;
        }

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('weather/index/index');
        return $resultRedirect;
    }
}

