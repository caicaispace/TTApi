# TT api PHP framework

基于 phalcon 与 swoole 的高性能 PHP api 框架


### 前序

#### 起源

 **TT 来源于《曼岛TT》摩托竞速运动项目**

### 特性

- TCP/UDP Server，多线程，EventLoop，事件驱动，异步，Worker进程组，Task异步任务，毫秒定时器，SSL/TLS隧道加密
- EventLoop API，让用户可以直接操作底层的事件循环，将socket，stream，管道等Linux文件加入到事件循环中。

### 优势:

- 简单易用开发效率高
- 并发百万TCP连接
- TCP/UDP/UnixSock
- 支持异步/同步
- 支持多进程/多线程
- CPU亲和性/守护进程
- MySQL 长链接/断线重连/防呆
- nginx + swoole 与 nginx + fpm 运行模式无缝切换

### 主要 PHP 扩展

- phalcon
- swoole
- redis
- memcached
- mongodb # 非必须

### 单元测试

- codeception

#### 环境要求

```
php >= 5.6
phalocn >= 3.2
swoole >= 1.9.23
```

### 开始

#### 安装与配置

- 安装 Phalcon 框架

```
https://github.com/phalcon/cphalcon.git
```

- 安装 Swoole 扩展

```
https://github.com/swoole/swoole-src.git
```

- 获取 TT api 框架

```
git@github.com:ycman/TTApi.git
```

- nginx + swoole 模式简易配置

```
server {
    root /data/wwwroot/TTApi/public/;
    server_name ttapi.com;

    location / {
        proxy_http_version 1.1;
        proxy_set_header Connection "keep-alive";
        proxy_set_header X-Real-IP $remote_addr;
        if (!-f $request_filename) {
             proxy_pass http://127.0.0.1:9501;
        }
    }
}
```

- nginx + fpm 模式简易配置

```$xslt
server {

	listen 80;
	server_name ttapi.com;

	index index.php index.html index.htm;

    location / {
            if (!-e $request_filename) {
                    rewrite ^(.*)$  /index.php?_url=$1 last;
                    break;
            }
    }

	root /data/wwwroot/TTApi/public/;
	#error_page 404 /404.html;

	if ( $query_string ~* ".*[\;'\<\>].*" ){
		return 404;
	}

	location ~ .*\.(php|php5)?$  {
		fastcgi_pass unix:/dev/shm/php-cgi.sock;
		fastcgi_index index.php;
		include fastcgi.conf;
	}
}
```

#### 运行与启动

- 执行以下命令启动框架

```
php bin/server start
php bin/server start --d # 守护进程模式
php bin/server start --d --p-9501 # 指定端口
```

- 其他命令
```
php bin/server stop # 停止框架
php bin/server reload # 热重启框架
php bin/server help # 获取帮助
```

### 讨论/交流

#### QQ 交流群

721733525