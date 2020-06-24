<?php


namespace App\Console\Commands;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

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

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {

        $config = [
            'appName'     => 'Test-apm',
//            'appVersion'  => '7.0.0',
            'serverUrl'   => 'http://10.0.4.227:8200',
//            'ampVersion' => 'v2'
//            'serviceName' => 'testt'
//            'apmVersion' => '7.7.1',
//            'apmVersion' => '',
//            'hostname' => 'ip-10-0-2-188'
//            'apmVersion' => '',
//            'secretToken' => 'DKKbdsupZWEEzYd4LX34TyHF36vDKRJP',
//            'hostname'    => 'stage-php',
//            'env'         => ['DOCUMENT_ROOT', 'REMOTE_ADDR', 'REMOTE_USER'],
//            'cookies'     => ['my-cookie'],
//            'httpClient'  => [
//                'verify' => false,
//                'proxy'  => 'tcp://localhost:8125'
//            ],
        ];


//        Config::all();
        $agent = new \PhilKra\Agent($config);

        dump(((bool)$agent) ? 'Agent created' : 'Agent didn t create');

        $transaction = $agent->startTransaction('TestTransaction');

//        dump(((bool)$transaction) ? 'Transact ceated' : 'Transact dedn t ceate');

        try {
            $request = new Request('POST', 'http://egor-pidor.su');
            $client = new Client();
            $client->send($request);

            throw new \Exception('Test Exception');
        } catch (\Exception $exception) {
            $agent->captureThrowable($exception);
            $debug = true;
        }

        $agent->stopTransaction($transaction->getTransactionName());
        dump('Transation stoped');
//        dump($agent);

        $test = $agent->send();
        dump('sended');
        dump($test);
        $dbg = true;
    }
}
