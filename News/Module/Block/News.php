<?php
namespace News\Module\Block;

use Magento\Framework\View\Element\Template;
use GuzzleHttp\Client;

class News extends Template
{
    protected $client;

    public function __construct(Template\Context $context, Client $client, array $data = [])
    {
        $this->client = $client;
        parent::__construct($context, $data);
    }

    public function getNews()
    {
        $apiUrl = 'https://vnexpress.net/rss/kinh-doanh.rss';
        try {
            $response = $this->client->request('GET', $apiUrl);
            $xmlString = $response->getBody()->getContents();
            $xml = simplexml_load_string($xmlString, "SimpleXMLElement", LIBXML_NOCDATA);

            $json = json_encode($xml);
            $newsArray = json_decode($json, true);

            $items = isset($newsArray['channel']['item']) ? $newsArray['channel']['item'] : [];
            return $items;
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}

