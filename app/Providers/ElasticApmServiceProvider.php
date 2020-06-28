<?php


namespace App\Providers;


use Carbon\Laravel\ServiceProvider as BaseServiceProvider;
use PhilKra\Agent;

class ElasticApmServiceProvider extends BaseServiceProvider
{
    public function register()
    {
//        parent::register();
        $this->registerAgent();
    }

    protected function registerAgent()
    {
        $this->app->singleton(Agent::class, function () {
            return new Agent($this->getAgentConfig());
        });
    }

    protected function getAgentConfig(): array
    {
        return [
            'appName' => 'Test',
            'serverUrl' => 'http://10.0.4.227:8200'
        ];
    }
}
