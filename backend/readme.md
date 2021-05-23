


# 配合yii2的RBAC 的bootstrap3 模版
* ui: composer require dmstr/yii2-adminlte-asset "2.*" 
* rbac: https://github.com/mdmsoft/yii2-admin

~~~

https://www.yiichina.com/tutorial/869
迁移角色和路由等4个表
./yii migrate --migrationPath=@yii/rbac/migrations




迁移菜单和后台用户2个表
./yii migrate --migrationPath=@mdm/admin/migrations


日志记录
./yii migrate --migrationPath=@yii/log/migrations/


./yii migrate

./yii initadminaccount

~~~


# crud 
* php composer.phar require warrence/yii2-kartikgii "dev-master"
* https://www.yiiframework.com/extension/yii2-kartikgii


