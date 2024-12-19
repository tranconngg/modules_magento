<?php
namespace WeatherApi\Module\Block;

use Magento\Framework\View\Element\Template;
use GuzzleHttp\Client;

class Weather extends Template
{
    protected $client;

    public function __construct(Template\Context $context, Client $client, array $data = [])
    {
        $this->client = $client;
        parent::__construct($context, $data);
    }

    public function getWeatherData()
    {
        $city = $this->getRequest()->getParam('city', 'Hanoi'); // Default to Hanoi
        $apiKey = '56bd9dc571087bfb86dd407ca4590375';
        $apiUrl = "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";
        try {
            $response = $this->client->request('GET', $apiUrl);
            $data = json_decode($response->getBody()->getContents(), true);
            return $data;
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function convertToFahrenheit($celsius)
    {
        return ($celsius * 9/5) + 32;
    }
}

