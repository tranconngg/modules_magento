<?php
namespace FinanceApi\Module\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use FinanceApi\Module\Block\FinancialData;

class FinancialDataPage extends Action
{
    protected $financialData;

    public function __construct(Context $context, FinancialData $financialData)
    {
        $this->financialData = $financialData;
        parent::__construct($context);
    }

    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}

