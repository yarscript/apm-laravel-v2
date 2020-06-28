<?php


namespace App\Services;


use Illuminate\Foundation\Application;
use PhilKra\Agent;
use PhilKra\Events\Transaction;
use Throwable;

class ApmCollectorService
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function captureThrowable(Throwable $thrown, array $context = [], ?Transaction $parent = null)
    {
        $this->app->make(Agent::class)->captureThrowable($thrown, $context, $parent);
    }

    public function send()
    {
        $this->app->make(Agent::class)->send();
    }
}
