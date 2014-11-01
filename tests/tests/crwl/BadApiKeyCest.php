<?php
use \CrwlTester;
use \iamsalnikov\crwl\Crwl;
use \Codeception\Util\Debug;

class BadApiKeyCest
{
    public function queryAdsWithWrongApiKey(CrwlTester $I)
    {
        $apiKey = 'wrongApiKey';
        $crwl = new Crwl($apiKey);

        $query = $crwl->ads();
        $ads = $query->get();

        $I->assertTrue(empty($ads));
        $I->assertTrue($query->getErrorCode() == 400);
    }

    public function queryAdWithWrongApiKey(CrwlTester $I)
    {
        $apiKey = 'wrongApiKey';
        $crwl = new Crwl($apiKey);

        $query = $crwl->ad();
        $ads = $query->get();

        $I->assertTrue(empty($ads));
        $I->assertTrue($query->getErrorCode() == 400);
    }
}