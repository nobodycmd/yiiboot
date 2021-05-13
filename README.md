### 简介
* 目的就是避免基础的重复性工作
* 直接基于 https://gitee.com/liushoukun/yiiadmin 这个后台

### 定制调整
* 自动模型生产
* service层

### init 
* 导入doc文件夹下的yiiadmin.sql 到数据库
* composer install
* ./yii automodels/go
* ./yii migrate
* php composer.phar dump-autoload -o