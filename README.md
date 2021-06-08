
## done
* 基于yii2高级项目模版，开箱即用常用组件支持
* 避免基础的重复性工作
* 让开发效率飞一般的感觉
* 前台网站/后台网站/控制台/API接口分离
* API多版本支持
* api doc md 支持
* 自动一键生成数据库表对象作为MODEL（有公用模型，以及分别应用于后台网站和API接口的子类模型)
* 重复生成模型，不影响自己编写的代码
* 自动挂载模型trait
* package（包含插件和模块）支持，后台可配
* 分布式自动雪花ID支持
* 并行跨语言文件锁支持

~~~



# 配合yii2的RBAC 的bootstrap3 模版
* ui: php composer.phar require dmstr/yii2-adminlte-asset "2.*" 

* rbac: php composer.phar require mdmsoft/yii2-admin "2.x-dev"

https://github.com/mdmsoft/yii2-admin


迁移角色和路由等4个表
./yii migrate --migrationPath=@yii/rbac/migrations


迁移菜单和后台用户2个表
./yii migrate --migrationPath=@mdm/admin/migrations


日志记录
./yii migrate --migrationPath=@yii/log/migrations/


./yii migrate

./yii initadminaccount


# crud 
* php composer.phar require warrence/yii2-kartikgii "dev-master"
* https://www.yiiframework.com/extension/yii2-kartikgii



~~~