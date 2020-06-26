<?php


namespace App\Helpers;


use PhilKra;

class ElasticApmPhp
{
    /**
     * @var PhilKra\Agent $agent
     */
    protected $agent;

    protected $transactions = [];

    protected $stoppedTransaction = [];

    /**
     * @var PhilKra\Events\Transaction
     */
    protected $currentTransaction;

    public function __call($name, $arguments)
    {
        if ($arguments) {
            return $this->agent->$name($arguments);
        }
        return $this->agent->$name();
    }

    public function __get($name)
    {
        try {
            return $this->$name;
        } catch (\Exception $exception) {
            $this->agent->captureThrowable($exception);
            return $exception;
        }
    }

    public function __construct($config = [])
    {
        $name = ['name' => 'Test'];
        $serverUrl = ['serverUrl' => 'http://10.0.4.227:8200'];

        $this->agent = new PhilKra\Agent([
            'appName' => 'Test',
            'serverUrl' => 'http://10.0.4.227:8200'
        ]);
    }

    /**
     * @param \Throwable $throwable
     * @return ElasticApmPhp
     */
    public function captureThrowable(\Throwable $throwable)
    {
        $this->agent->captureThrowable($throwable);
        return $this;
    }

//    public function startTransaction(string $name, array $context = [], float $start = null): ElasticApmPhp
//    {
//        $this->transactions[$name] = $this->agent->startTransaction($name, $context, $start);
//        $this->currentTransaction = $this->transactions[$name];
//        return $this;
//    }
//
//    public function stopTransaction(string $name, array $meta = []): ElasticApmPhp
//    {
//        $this->agent->stopTransaction($name, $meta);
//        $this->stoppedTransaction[$name] = $this->transactions[$name];
//        unset($this->transactions[$name]);
//        return $this;
//    }
//
//    public function get()
//    {
//        return $this->currentTransaction;
//    }
//
//    public function getAll()
//    {
//        return $this->transactions;
//    }
//
//    public function setTransaction(string $name)
//    {
//        $this->currentTransaction =
//            isset($this->transactions[$name]) ? $this->transactions[$name] : $this->currentTransaction;
//        return $this;
//    }
//
//    public function setParent($transaction)
//    {
//        if (is_string($transaction)) {
//            $this->currentTransaction->setParent();
//        }
//    }

}
