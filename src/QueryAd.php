<?php
namespace iamsalnikov\crwl;

/**
 * Запрос на все объявлениe
 *
 * @author Alexey Salnikov <me@iamsalnikov.ru>
 */
class QueryAd extends Query
{
    const PARAM_URL = 'url';

    /**
     * Конструктор
     *
     * @param $apiKey
     */
    public function __construct($apiKey)
    {
        $this->queryPath = $this->apiUrl . '/' . self::QUERY_AD;
        parent::__construct($apiKey);
    }

    /**
     * Устанавливаем Url
     *
     * @param $url
     * @return $this
     */
    public function url($url)
    {
        $this->setParameter(self::PARAM_URL, $url);
        return $this;
    }
}