
服务器操作系统和nginx php-fpm 优化配置

centos 优化  ipv4以及打开文件数

http://doc.workerman.net/appendices/kernel-optimization.html

https://www.iteye.com/blog/jameswxx-2096461


nginx php-fpm backlog 优化


关于php-fpm进程数，理论上应该是开启和CPU核数一样

考虑到操作系统切换等，比内核数大2个即可

当时，如果PHP-FPM处理进程存在IO等待，这时候如果进行大量请求，IO等待
进程无法及时提供服务，此时应该增加更多进程数提供服务

应该尽量避免PHP-FPM出现IO等待这样的代码出现，业务允许的情况下应该发给
队列后进行守护进程处理