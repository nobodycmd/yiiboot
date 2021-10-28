
服务器操作系统和nginx php-fpm 优化配置

centos 优化  ipv4以及打开文件数

http://doc.workerman.net/appendices/kernel-optimization.html

https://www.iteye.com/blog/jameswxx-2096461


nginx php-fpm backlog 优化

~~~
关于php-fpm进程数，不考虑硬盘等IO情况理想情况下应该是开启和CPU核数一样

如果是纯计算，比内核数大2个即可

如果是偏IO等待柱塞（多数都是基于数据库的IO），进程无法及时提供服务，此时应该增加更多进程数提供服务

应该尽量避免PHP-FPM出现IO等待这样的代码出现，业务允许的情况下应该发给
队列后进行守护进程处理

~~~

~~~
FPM的多进程FORK在IO下大流量下显得力不从心
破局1：在不改变其他的情况下，应该让FPM更多作计算工作，IO异步交给守护进程处理
破局2：不依赖FPM进行HTTP处理，直接依赖SWOOLE、workerman等进行常驻内存进行处理
~~~



