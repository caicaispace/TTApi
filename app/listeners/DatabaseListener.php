<?php

namespace App\Listeners;

use Phalcon\Db\Profiler;
use Phalcon\Db\Adapter\Pdo;
use Phalcon\Events\Event;
use Library\Base\TDi;

/**
 * Class DatabaseListener
 *
 * @package Xueron\FastDPhalcon\Listener
 */
class DatabaseListener
{
    use TDi;

    /**
     * @var \Phalcon\Db\Profiler
     */
    protected $profiler;

    /**
     * Creates the profiler and starts the logging
     */
    public function __construct()
    {
        $this->profiler = new Profiler();
    }

    /**
     *
     * This is executed if the event triggered is 'beforeQuery'
     *
     * @param Event $event
     * @param Pdo $connection
     */
    public function beforeQuery(Event $event, Pdo $connection)
    {
        $this->profiler->startProfile(
            $connection->getSQLStatement(), $connection->getSQLVariables()
        );
    }

    /**
     *
     * This is executed if the event triggered is 'afterQuery'
     *
     * @param Event $event
     * @param Pdo $connection
     */
    public function afterQuery(Event $event, Pdo $connection)
    {
        $this->profiler->stopProfile();

        $profile = $this->profiler->getLastProfile();
        $sql   = $profile->getSQLStatement();
        $vars  = $profile->getSQLVariables();
        if (count($vars)) {
            $sql = str_replace(array_map(function ($v) {
                return ':' . $v;
            }, array_keys($vars)), array_values($vars), $sql);
        }
        $start = $profile->getInitialTime();
        $final = $profile->getFinalTime();
        $total = $profile->getTotalElapsedSeconds();
        $loggerName = $this->getConfig('databases.mysql.logger_name');
        $loggerContent = "[Database]: Start=$start, Final=$final, Total=$total, SQL=$sql";
        $this->getDi()->getShared('logger',[$loggerName])->log(\Phalcon\Logger::DEBUG, $loggerContent);
    }

    /**
     * @return \Phalcon\Db\Profiler
     */
    public function getProfiler()
    {
        return $this->profiler;
    }
}