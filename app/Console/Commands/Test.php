<?php


namespace App\Console\Commands;


use App\Helpers\ElasticApmPhp;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Console\Command;
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
     * @var ElasticApmPhp|Agent
     */
    protected $apmPhp;

    public function __construct(ElasticApmPhp $apmPhp)
    {
        parent::__construct();

        $this->apmPhp = $apmPhp;
    }

    public function handle(): void
    {
        try {
            throw new \Exception('test Exception with helper');
        } catch (\Exception $exception) {
            $transaction = $this->apmPhp->captureThrowable($exception);
        }
    }
}
