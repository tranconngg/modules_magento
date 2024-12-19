<?php
namespace FinanceApi\Module\Block;

use Magento\Framework\View\Element\Template;
use GuzzleHttp\Client;

class FinancialData extends Template
{
    protected $client;

    public function __construct(Template\Context $context, Client $client, array $data = [])
    {
        $this->client = $client;
        parent::__construct($context, $data);
    }

    public function getFinancialData()
    {
        $apiUrl = 'https://portal.vietcombank.com.vn/Usercontrols/TVPortal.TyGia/pXML.aspx?b=68';
        try {
            $response = $this->client->request('GET', $apiUrl);
            $xmlString = $response->getBody()->getContents();
            $xml = simplexml_load_string($xmlString);

            $data = [];
            foreach ($xml->Exrate as $rate) {
                $data[] = [
                    'CurrencyCode' => (string)$rate['CurrencyCode'],
                    'CurrencyName' => (string)$rate['CurrencyName'],
                    'Buy' => (string)$rate['Buy'],
                    'Transfer' => (string)$rate['Transfer'],
                    'Sell' => (string)$rate['Sell']
                ];
            }
            return $data;
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}

