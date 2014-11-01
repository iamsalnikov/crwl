<?php
namespace iamsalnikov\crwl;

/**
 * Запрос на все объявления
 *
 * @author Alexey Salnikov <me@iamsalnikov.ru>
 */
class QueryAds extends Query
{
    const PARAM_SOURCE = 'source';
    const PARAM_MIN_DATE = 'min_date';
    const PARAM_MAX_DATE = 'max_date';
    const PARAM_REGION = 'region';
    const PARAM_LAST = 'last';

    /**
     * Конструктор
     *
     * @param $apiKey
     */
    public function __construct($apiKey)
    {
        $this->queryPath = $this->apiUrl . '/' . self::QUERY_ADS;
        parent::__construct($apiKey);
    }

    /**
     * Устанавливаем источник
     *
     * @param $src
     * @return $this
     */
    public function source($src)
    {
        $this->setParameter(self::PARAM_SOURCE, $src);
        return $this;
    }

    /**
     * Устанавливаем минимальную дату
     *
     * @param $minDate
     * @return $this
     */
    public function minDate($minDate)
    {
        $this->setParameter(self::PARAM_MIN_DATE, $minDate);
        return $this;
    }

    /**
     * Устанавливаем максимальную дату
     *
     * @param $maxDate
     * @return $this
     */
    public function maxDate($maxDate)
    {
        $this->setParameter(self::PARAM_MAX_DATE, $maxDate);
        return $this;
    }

    /**
     * Устанавливаем регион
     *
     * @param $region
     * @return $this
     */
    public function region($region)
    {
        $this->setParameter(self::PARAM_REGION, $region);
        return $this;
    }

    /**
     * Устанавливаем часы
     *
     * @param $hours
     * @return $this
     */
    public function last($hours)
    {
        $this->setParameter(self::PARAM_LAST, $hours);
        return $this;
    }
}