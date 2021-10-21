<?php
namespace services;

/**
 * 提供进程的执行
 * 状态查看
 * 停止
 * @package app\services
 */
class ProcessService
{

    private $pid;
    private $command;

    public function __construct($_command = false)
    {
        if ($_command != false) {
            $this->command = $_command;
            $this->runCom();
        }
    }

    private function runCom()
    {
        $command = 'nohup ' . $this->command . ' > /dev/null 2>&1 & echo $!';
        exec($command, $op);
        $this->pid = (int)$op[0];
    }

    public function setPid($pid)
    {
        $this->pid = $pid;
    }

    public function getPid()
    {
        return $this->pid;
    }

    public function status()
    {
        $command = 'ps -p ' . $this->pid;
        exec($command, $op);
        if (!isset($op[1])) return false;
        else return true;
    }

    public function start()
    {
        if ($this->command)
            $this->runCom();
        return true;
    }

    public function stop($force = false)
    {
        if ($force) {
            $command = 'kill -9 ' . $this->pid;
            exec($command);
            return true;
        }

        $command = 'kill ' . $this->pid;
        exec($command);
        if ($this->status() == false) return true;
        else return false;
    }

}