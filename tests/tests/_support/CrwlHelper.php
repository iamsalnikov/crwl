<?php
namespace Codeception\Module;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class CrwlHelper extends \Codeception\Module
{

    protected $requiredFields = ['apiKey'];

    protected $apiKey = '';

    public function _beforeSuite($settings = [])
    {
        $this->apiKey = $settings['modules']['config']['CrwlHelper']['apiKey'];
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

}