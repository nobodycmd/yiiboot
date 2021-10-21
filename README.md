
## 让开发效率飞一般的感觉
* 开箱即用常用组件支持
* 避免基础的重复性工作
* 前台网站/后台网站/控制台/API接口分离
* restful api多版本支持,返回格式支持json xml html
* api doc md 支持
* 自动一键生成数据库表对象作为MODEL（有公用模型，以及分别应用于后台网站和API接口的子类模型)
* 重复生成模型，不影响自己编写的代码
* 自动挂载模型trait
* 自定义 crud 支持
* package（包含插件和模块）支持，模块可支持独立部署
* 自动雪花ID支持
* 后台自动日志记录，可记录下数据的变动走向
* 并行跨语言文件锁支持
* [pdf 支持，已设置为开箱即用组件](https://demos.krajee.com/mpdf)
* [http client support](https://github.com/yiisoft/yii2-httpclient/blob/master/docs/guide/basic-usage.md)
* [redis 支持](https://github.com/yiisoft/yii2-redis)
* 队列任务支持，配套的supervisor配置生成
* 系统部署优化centos nginx php-fpm
* [官方超1000个扩展资源](https://www.yiiframework.com/extensions)
* [krajee 社团扩展](https://demos.krajee.com/) 
* rundeck跨服务器任务执行管理（单独软件)


## composer install 后
~~~
./yii migrate
./yii initadminaccount
~~~


# crud 扩展
* https://www.yiiframework.com/extension/yii2-kartikgii


