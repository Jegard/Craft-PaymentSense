<?php

namespace Craft;

class PaymentSensePlugin extends BasePlugin
{

    private $commerceInstalled = false;

    public function init()
    {
        $commerce = craft()->db->createCommand()
            ->select('id')
            ->from('plugins')
            ->where("class = 'Commerce'")
            ->queryScalar();
        if($commerce){
            $this->commerceInstalled = true;
        }
    }

    public function getName()
    {
        return "PaymentSense Commerce Gateway";
    }

    /**
     * Returns the plugin’s version number.
     *
     * @return string The plugin’s version number.
     */
    public function getVersion()
    {
        return "0.1";
    }

    /**
     * Returns the plugin developer’s name.
     *
     * @return string The plugin developer’s name.
     */
    public function getDeveloper()
    {
        return "Luca Jegard";
    }

    /**
     * Returns the plugin developer’s URL.
     *
     * @return string The plugin developer’s URL.
     */
    public function getDeveloperUrl()
    {
        return "#";
    }

    public function commerce_registerGatewayAdapters(){
        if($this->commerceInstalled) {
            require __DIR__ . '/vendor/autoload.php';

            require_once __DIR__.'/PaymentSense_GatewayAdapter.php';

            return ['\Commerce\Gateways\Omnipay\PaymentSense_GatewayAdapter'];

        }
        return [];
    }
}
