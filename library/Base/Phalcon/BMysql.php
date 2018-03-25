<?php

namespace  Library\Base\Phalcon;

use Phalcon\Db\Adapter\Pdo\Mysql;
use Library\Swoole\Timer;

class BMysql
{
    use TDi;

    /**
     * workerId
     *
     * @var int
     */
    protected $workerId;

    /**
     * 数据库配置
     *
     * @var array
     */
    protected $options;

    /**
     * 定时器
     *
     * @var int
     */
    protected $timerId;

    /**
     * 重连尝试次数
     *
     * @var int
     */
    protected $maxRetry;

    /**
     * Database constructor.
     *
     * @param array $options
     *
     * @param array $workerId
     */
    public function __construct( $workerId, array $options = null)
    {
        if (null === $options) {
            $options = self::getConfig('databases.mysql.options');
        }
        $this->options = $options;
        $this->workerId = $workerId;
    }

//    public function ping() {
//        try {
//            $this->fetchAll('SELECT 1');
//        }
//        catch (\Exception $e) {
//            $this->connect();
//        }
//        return $this;
//    }

    public function getWorkerId()
    {
        return $this->workerId;
    }

    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param $key
     */
    public function reconnect($key)
    {
        $this->getConnection($key, true);
    }

    /**
     * @param      $key
     * @param bool $force
     *
     * @return \Phalcon\Db\Adapter
     */
    public function getConnection($key, $force = false)
    {
        if (!isset($this->options[$key])) {
            throw new \LogicException(sprintf('No set %s database', $key));
        }

        $serviceName = 'databases.mysql.connected.' .$this->workerId. $key;
        if ($force || !self::getDi()->has($serviceName)) {
            if (self::getDi()->has($serviceName)) {
                // Close first
                self::getDi()->getShared($serviceName)->close();
                self::getDi()->remove($serviceName);
            }

            $config = $this->options[$key];
            $config += [
                "options"  => [ //长连接配置
                    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8mb4'",
                    \PDO::ATTR_PERSISTENT => true,//长连接
                ]
            ];

            $connection = new Mysql([
                'host'       => $config['host'],
                'port'       => $config['port'],
                'username'   => $config['username'],
                'password'   => $config['password'],
                'dbname'     => $config['dbname'],
                'charset'    => isset($config['charset']) ? $config['charset'] : 'utf8mb4',
                'persistent' => isset($config['persistent']) ? $config['persistent'] : false,
            ]);
            $connection->setEventsManager(self::getDi()->getEventsManager());
            self::getDi()->setShared($serviceName, $connection);
            /**
             * Database connection is created based in the parameters defined in the configuration file
             */
            self::getDi()->setShared('db', function () use ($serviceName) {
                var_dump('$serviceName --> '. $serviceName);
                return self::getDi()->get($serviceName);
            });
        }

        return self::getDi()->getShared($serviceName);
    }

    /**
     * 获取连接的信息
     *
     * @param $key
     *
     * @return array
     */
    public function getConnectionInfo($key)
    {
        $connection = $this->getConnection($key);

        $output = [
            'server'     => 'SERVER_INFO',
            'driver'     => 'DRIVER_NAME',
            'client'     => 'CLIENT_VERSION',
            'version'    => 'SERVER_VERSION',
            'connection' => 'CONNECTION_STATUS',
        ];

        foreach ($output as $key => $value) {
            $output[$key] = @$connection->getInternalHandler()->getAttribute(constant('PDO::ATTR_' . $value));
        }

        return $output;
    }

    /**
     * {@inheritdoc}
     */
    public function initPool()
    {
        if ($this->timerId) {
            swoole_timer_clear($this->timerId);
            $this->timerId = null;
        }

        // TODO: 多数据库连接
        $key = 'master';
        $this->getConnection($key, true);

//        // 创建数据库连接
//        foreach ($this->config as $key => $config) {
//            $this->getConnection($key, true);
//        }

//        // 打开数据库调试日志
//        if ($this->config->get('phalcon.debug', false)) {
//            self::getDi()->getEventsManager()->attach('db', new DatabaseListener());
//        }

        // 插入一个定时器，定时连一下数据库，防止IDEL超时断线
        if (self::getConfig('databases.mysql.antiidle', false)) {
            $interval = self::getConfig('databases.mysql.interval', 100) * 1000; // 定时器间隔
            $this->maxRetry = self::getConfig('databases.mysql.max_retry', 3); // 重连尝试次数
            $this->timerId = Timer::loop($interval, function () {
                $this->reconnectHandle();
            });
        }
    }

    public function reconnectHandle()
    {
        $pid = getmypid();
        $time = microtime(1);
        foreach ($this->getOptions() as $key => $option) {
            $tryTimes = 1;
            while ($tryTimes < $this->maxRetry) {
                try {
                    $info = $this->getConnectionInfo($key);
//                    logger()->log(Logger::DEBUG, "[$pid] [Database $key] [$time] AntiIdle: " . $info['server']);
                    break;
                } catch (\Exception $e) {
                    if (preg_match("/(errno=32 Broken pipe)|(MySQL server has gone away)/", $e->getMessage())) {
//                        logger()->log(Logger::ERROR, "[$pid] [Database $key] Connection lost({$e->getMessage()}), try to reconnect, tried times $tryTimes");
                        $this->reconnect($key);
                        $tryTimes ++;
                        continue;
                    }
//                    logger()->log(Logger::ERROR, "[$pid] [Database $key] Quit on exception: " . $e->getMessage());
                    exit(255);
                }
            }
        }
    }
}