<?php


namespace App\Console\Commands;


//use App\Helpers\ElasticApmPhp;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use PhilKra\Agent as ApmAgent;

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
     * @var ApmAgent
     */
    protected $apmAgent;

    public function __construct(ApmAgent $apmAgent)
    {
        parent::__construct();

        $this->apmAgent = $apmAgent;
    }

    public function handle(): void
    {
        try {
            throw new \Exception('test Exception with helper');
        } catch (\Exception $exception) {
            $this->apmAgent->captureThrowable($exception);
        }

    }
}
