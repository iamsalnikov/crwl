<?php
use \CrwlTester;
use \iamsalnikov\crwl\Crwl;
use \iamsalnikov\crwl\Sources;
use \iamsalnikov\crwl\Regions;

class AdQueryCest
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

    public function getForAutoRu(CrwlTester $I)
    {
        $ads = $this->crwl->ads()->region(Regions::MOSCOW)->source(Sources::AUTO_RU)->get();

        $I->assertNotEmpty($ads);

        foreach ($ads as $ad) {
            $car = $this->crwl->ad()->url($ad['url'])->get();
            $I->assertNotEmpty($car);
            $I->assertEquals($ad['phone'], $car['phone']);
        }
    }

    public function dontExistsUrl(CrwlTester $I)
    {
        $ads = $this->crwl->ads()->region(Regions::MOSCOW)->source(Sources::AUTO_RU)->get();

        $I->assertNotEmpty($ads);

        foreach ($ads as $ad) {
            $car = $this->crwl->ad()->url($ad['url'] . 'test')->get();
            $I->assertFalse($car);
        }
    }
}