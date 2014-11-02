<?php
use \CrwlTester;
use \iamsalnikov\crwl\Crwl;

class BadApiKeyCest
{
    public function queryAdsWithWrongApiKey(CrwlTester $I)
    {
        $apiKey = 'wrongApiKey';
        $crwl = new Crwl($apiKey);

        $query = $crwl->ads();
        $ads = $query->get();

        $I->assertFalse($ads);
        $I->assertEquals(400, $query->getErrorCode());
    }

    public function queryAdWithWrongApiKey(CrwlTester $I)
    {
        $apiKey = 'wrongApiKey';
        $crwl = new Crwl($apiKey);

        $query = $crwl->ad();
        $ads = $query->get();

        $I->assertFalse($ads);
        $I->assertEquals(400, $query->getErrorCode());
    }
}