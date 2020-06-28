<?php


namespace App\Console\Commands;


use Illuminate\Console\Command;
use App\Facades\ApmCollector;
use Illuminate\Support\Collection;
use PhilKra\Agent;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test-run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test';

    /**
//     * @var ElasticApmPhp|Agent
//     * @var ApmAgent
     */
    protected $apmAgent;

    public function __construct()
    {
        parent::__construct();
//        $agent->startTransaction('test');
//        $this->apmAgent = $apmAgent;
    }

    public function handle(): void
    {
        try {
            throw new \Exception('test Exception with helper');
        } catch (\Exception $exception) {
//            $this->apmAgent->captureThrowable($exception);
            ApmCollector::captureThrowable($exception);
        }

        $collection = (new Collection())->first()->toString();

    }
}
