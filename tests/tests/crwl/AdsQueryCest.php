<?php
use \CrwlTester;
use \iamsalnikov\crwl\Crwl;
use \iamsalnikov\crwl\Sources;
use \iamsalnikov\crwl\Regions;

class AdsQueryCest
{
    /**
     * @var Crwl
     */
    public $crwl = null;

    public function _before(CrwlTester $I)
    {
        $apiKey = $I->getApiKey();
        $this->crwl = new Crwl($apiKey);
    }

    public function _after(CrwlTester $I)
    {
    }

    public function getForMoscowAutoRu(CrwlTester $I)
    {
        $query = $this->crwl->ads();
        $ads = $query->region(Regions::MOSCOW)->source(Sources::AUTO_RU)->get();

        $I->assertTrue(is_array($ads));
        $I->assertFalse(empty($ads));

        foreach ($ads as $ad) {
            $I->assertEquals("Москва", $ad['region']);
        }
    }

    public function getForMoscowWithoutSource(CrwlTester $I)
    {
        $query = $this->crwl->ads();
        $ads = $query->region(Regions::MOSCOW)->get();

        $I->assertTrue(is_array($ads));
        $I->assertTrue(empty($ads));
    }

    public function getFromAutoRuWithoutCity(CrwlTester $I)
    {
        $query = $this->crwl->ads();
        $ads = $query->source(Sources::AM_RU)->get();

        $I->assertTrue(is_array($ads));
        $I->assertFalse(empty($ads));
    }
}