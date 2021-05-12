#!/usr/bin/env bash

yum clean all && yum makecache && yum install -y wget &&\
    ln -sf /usr/share/zoneinfo/Asia/Shanghai /etc/localtime &&\
 wget -O /etc/yum.repos.d/CentOS-Base.repo http://mirrors.163.com/.help/CentOS7-Base-163.repo &&\
 rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm &&\
 # php 包源
 rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm &&\
 rpm -Uvh http://repo.mysql.com/mysql57-community-release-el7-8.noarch.rpm &&\
 yum install epel-release &&\
#安装依赖
yum -y install gcc gcc-c++\
autoconf wget \
psmisc \
gperftools-devel \
tar \
passwd \
openssl openssl-devel \
openssh-server \
openssh-clients \
initscripts \
unzip pcre pcre-devel zlib zlib-devel git \
libxml2 libxml2-devel curl curl-devel \
libjpeg libjpeg-devel libpng libpng-devel freetype freetype-devel \
python-setuptools dos2unix gperf \
libevent libevent-devel bzip2-devel ncurses-devel \
boost libtool boost-devel* libuuid-devel python-sphinx.noarch \
&&\
# 安装PHP7,还有5.5、5.6、7.0,7.1,7.2也在上面的包源里面
# 以下安装7.0版本，如果是其他版本，比如5.6，将70w修改为56w即可
# 具体可 yum search php进行查看
 yum install -y php70w \
 php70w-bcmath \
 php70w-cli \
 php70w-common \
 php70w-fpm \
 php70w-opcache \
 php70w-gd \
 php70w-mysqlnd \
 php70w-mbstring \
 php70w-mcrypt \
 php70w-mysqlnd \
 php70w-pdo \
 php70w-pear \
 php70w-pecl-redis \
 php70w-pecl-memcached \
 php70w-pecl-mongodb \
 php70w-xml  \
 php70w-devel\
 libevent-devel\
&&\
#安装常用软件
nginx supervisor beanstalkd  redis git mysql-server
&&\
systemctl start supervisord
#mysql  https://www.cnblogs.com/jorzy/p/8455519.html


#备注：php-fpm默认采用apache:apache进行的运行，且php-fpm里面的session.save_path也是apache:root，那么应该将项目的默认用户也设置为apache:apache为最方便的

# 安装 event for php
&&\
pecl install event
&&\
echo "extension=event.so" >> /etc/php.d/sockets.ini

# LINUX优化
# http://doc.workerman.net/appendices/kernel-optimization.html

