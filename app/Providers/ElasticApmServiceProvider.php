<?php


namespace App\Providers;


use App\Services\ApmCollectorService;
use Carbon\Laravel\ServiceProvider as BaseServiceProvider;
use PhilKra\Agent;

class ElasticApmServiceProvider extends BaseServiceProvider
{
    public function register()
    {
//        parent::register();
        $this->registerFacades();
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

    protected function registerFacades(): void
    {
        $this->app->bind('apm-collector', function ($app) {
            return $app->make(ApmCollectorService::class);
        });
    }
}
