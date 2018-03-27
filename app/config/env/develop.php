<?php

return [
    'default' => 'redis',
    'options' => [
        /**
         * JWT lifetime, in seconds.
         */
        'lifetime' => 86400,
    ],
    /**
     * databases caches
     */
    'databases' => [
        'mysql' =>[
            'antiidle'  => true, // 开启后，会通过定时器定时访问一下数据库，方式发呆断线
            'interval'  => 3600,  // 断线重连定时器间隔
            'max_retry' => 3,    // 断线重连重连尝试次数
            'adapter' => \Phalcon\Db\Adapter\Pdo\Mysql::class,
            'options' => [
                'master' => [
                    'host' => 'localhost',
                    'port' => 3306,
                    'username' => 'root',
                    'password' => 'root',
                    'dbname' => 'tt_demo',
                    'charset' => 'utf8mb4',
                ],
                'slave' => [
                    'slave1' => [
                        'host' => '127.0.0.1',
                        'port' => 3306,
                        'username' => 'root',
                        'password' => 'root',
                        'dbname' => 'test',
                        'charset' => 'utf8mb4',
                    ],
                    'slave2' => [
                        'host' => '127.0.0.1',
                        'port' => 3306,
                        'username' => 'root',
                        'password' => 'root',
                        'dbname' => 'test',
                        'charset' => 'utf8mb4',
                    ],
                ]
            ],
        ]
    ],
    /**
     * frontend caches
     */
    'frontend_caches' => [

    ],
    /**
     * backend caches
     */
    'backend_caches' => [
        'redis' => [
            'adapter' => \Phalcon\Cache\Backend\Redis::class,
            'options' => [
                "host"       => "localhost",
                "port"       => 6379,
                "auth"       => "ttapi",
                "persistent" => false,
                "index"      => 0,
                "lifetime"   => 172800,
            ],
        ],
        'memcached' => [
            'adapter' => \Phalcon\Cache\Backend\Libmemcached::class,
            'options' => [
                "servers" => [
                    [
                        "host"      => "127.0.0.1",
                        "port"      => 11211,
                        "weight"    => 1,
                        "lifetime"  => 172800,
                    ],
                ],
                "client" => [
                    \Memcached::OPT_HASH       => \Memcached::HASH_MD5,
                    \Memcached::OPT_PREFIX_KEY => "prefix.",
                ],
            ],
        ],
        'memcache' => [
            'adapter' => \Phalcon\Cache\Backend\Memcache::class,
            'options' => [
                "host"       => "localhost",
                "port"       => 11211,
                "persistent" => false,
                "lifetime"   => 172800,
            ],
        ],
    ],
];
