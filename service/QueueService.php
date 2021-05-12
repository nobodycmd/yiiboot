<?php
namespace app\service;



use Pheanstalk\Pheanstalk;
use Pheanstalk\PheanstalkInterface;

class QueueService
{
    public $tubeOrder = 'order';

    private $instance;

    public function __construct($persistent=false)
    {
        $this->instance = new Pheanstalk('127.0.0.1',PheanstalkInterface::DEFAULT_PORT, null, $persistent);
    }

    public function getInstance(){
        return $this->instance;
    }

    public function put($tube, $string){
        $this->getInstance()->putInTube($tube,$string);
    }

}