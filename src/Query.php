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
     * Сообщение с ошибкой
     *
     * @var string
     */
    protected $errorMessage = '';

    /**
     * Код ошибки
     *
     * @var string
     */
    protected $errorCode = '';

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
        $this->clearErrors();

        $this->params['api_key'] = $this->apiKey;
        $params = http_build_query($this->params);
        $url = $this->queryPath . '/?' . $params;

        $request = new CURL($url);
        $response = $request->get();

        if ($response->status() != 200) {
            $this->setErrorCode($response->status());
            $this->setErrorMessage((string) $response);
            return false;
        }

        return json_decode($response, true);
    }

    /**
     * Получаем код ошибки
     *
     * @return string
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * Устанавливаем код ошибки
     *
     * @param string $errorCode
     * @return $this
     */
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;
        return $this;
    }

    /**
     * Получаем сообщение об ошибке
     *
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * Устанавливаем сообщение об ошибке
     *
     * @param string $errorMessage
     * @return $this
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
        return $this;
    }

    /**
     * Очищаем ошибки
     *
     * @return $this
     */
    public function clearErrors()
    {
        $this->setErrorCode('')->setErrorMessage('');
        return $this;
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