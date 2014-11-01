<?php
namespace iamsalnikov\crwl;

use \BCA\CURL\CURL;

/**
 * Компонент для построения запроса
 *
 * @author Alexey Salnikov <me@iamsalnikov.ru>
 */
class Query
{
    protected $apiUrl = 'http://crwl.ru/api/rest/v1';

    const QUERY_ADS = 'get_ads';
    const QUERY_AD = 'get_ad';

    /**
     * Ключ для API
     *
     * @var string
     */
    protected $apiKey = '';

    /**
     * Параметры запроса
     *
     * @var array
     */
    protected $params = [];

    /**
     * Путь, по которому будем делать запрос
     *
     * @var string
     */
    protected $queryPath = '';

    /**
     * Конструктор
     *
     * @param $apiKey - ключ для работы с API
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Делаем запрос на получение результата
     *
     * @return array
     */
    public function get()
    {
        $this->params['api_key'] = $this->apiKey;
        $params = http_build_query($this->params);
        $url = $this->queryPath . '/?' . $params;

        $request = new CURL($url);
        $response = $request->get();

        return json_decode($response, true);
    }

    /**
     * Установка параметра
     *
     * @param $name
     * @param $value
     * @return $this
     */
    protected function setParameter($name, $value)
    {
        $this->params[$name] = $value;
        return $this;
    }

}