<?php
/* swoole config */
return [
    'swoole' => [
        "SERVER"=> [
            "LISTEN"         => "0.0.0.0",
            "SERVER_NAME"    => "TT api",
            "PORT"           => 9501,
            "RUN_MODE"       => SWOOLE_PROCESS,//不建议更改此项
            "SERVER_TYPE"    => \Library\Swoole\Init\Config::SERVER_TYPE_WEB,
            "CONFIG"=> [
                'task_worker_num'  => 8, //异步任务进程
                'task_max_request' => 10,
                'max_request'      => 5000,//强烈建议设置此配置项
                'worker_num'       => 8,
                'document_root'         => DOCROOT.'/public',
                'enable_static_handler' => true,
            ],
        ],
        "DEBUG"=> [
            "LOG"=>1,
            "DISPLAY_ERROR"=>1,
            "ENABLE"=>true,
        ],
        "CONTROLLER_POOL"=>true//web或web socket模式有效
    ]
];