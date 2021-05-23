<?php

namespace torfenagar\HolooThirdParty;

use Illuminate\Support\ServiceProvider;
use Torfenagar\HolooThirdParty\clients\GuzzleClient;
use Torfenagar\HolooThirdParty\HolooTP;

class HolooThirdPartyServiceProvider extends ServiceProvider
{
    /**
     * Register default config
     * and main class instance.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/HolooThirdParty.php', 'HolooThirdParty');
        $this->app->instance(HolooTP::class, $this->getInstance());
    }

    private function getInstance()
    {
        $serial_number = (string) config('HolooThirdParty.serial_number', null);
        $api_key = (string) config('HolooThirdParty.api_key', null);
        $lang = (string) config('HolooThirdParty.lang', 'fa');
        $sandbox = (string) config('HolooThirdParty.sandbox', '0');
        $client = new GuzzleClient($sandbox);
        return new HolooTP($serial_number, $api_key, $lang, $sandbox, $client, true);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
