
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
* package（包含插件和模块）支持
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


## 最牛逼的点
* 只要用yii2开发的系统，基本只需要进行少量工作调整，即可作为模块集成进系统里面去
  * 代码越规范，越符合yii2官方手册上所写，越容易集成
* 高度解除耦合，模块稍微调整下即可独立部署，基本无其他依赖


## package设计 模块和插件的区别
* package 字面意思为包，本人历经c# java php这几个主力语言的应用，包就是提供代码粒度更粗的复用
* 模块是独立的软件单元，由模型，视图， 控制器和其他支持组件组成， 终端用户可以访问在应用主体中已安装的模块的控制器
  * 模块被当成小应用主体来看待，和应用主体不同的是， 模块不能单独部署，必须属于某个应用主体
* 插件主要是对应用主体里面的事件进行一个处理，涉及到MVC等结构放到模块里面去
* 新建一个模块或者插件，可直接拷贝现有的同级其他文件夹



## composer install 后
~~~
./yii migrate
./yii initadminaccount
~~~


# crud 扩展
* https://www.yiiframework.com/extension/yii2-kartikgii


