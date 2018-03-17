# TT PHP framework

基于 phalcon 与 swoole 的高性能 PHP 框架（**开发中... 请勿使用**）


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
- 支持异步/同步/协程
- 支持多进程/多线程
- CPU亲和性/守护进程

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