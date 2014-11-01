<?php
namespace iamsalnikov\crwl;

/**
 * Класс для получения данных из Crwl.ru
 *
 * Описание Api находится [здесь](http://crwl.ru/api/)
 *
 * @author Alexey Salnikov <me@iamsalnikov.ru>
 */
class Crwl
{
    /**
     * Ключ для работы с API
     *
     * @var string
     */
    protected $apiKey = '';

    /**
     * Конструктор
     *
     * @param $apiKey
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Получаем объект для запроса на объявления к crwl
     *
     * @return QueryAds
     */
    public function ads()
    {
        return new QueryAds($this->apiKey);
    }

    /**
     * Получаем объект для запроса на объявление к crwl
     *
     * @return QueryAd
     */
    public function ad()
    {
        return new QueryAd($this->apiKey);
    }
}