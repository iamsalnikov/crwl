<?php
namespace Codeception\Module;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class CrwlHelper extends \Codeception\Module
{
    protected $apiKey = '';

    public function _beforeSuite($settings = [])
    {
        $config = $settings['modules']['config']['CrwlHelper'];

        if (isset($config['envVariable'])) {
            $this->apiKey = getenv($config['envVariable']);
        } elseif (isset($config['apiKey'])) {
            $this->apiKey = $config['apiKey'];
        }
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

}