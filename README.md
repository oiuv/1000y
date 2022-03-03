# [云端千年](https://1000y.gameivy.com)

云端千年是一个怀旧千年游戏公益服务器，免费娱乐，欢迎来云端千年游戏，交流QQ群：`2887111`。你也可以使用[云端千年源码](https://github.com/oiuv/1000yTGS)架设自己的游戏服务器。

项目基于Laravel 6.0开发，PHP版本要求`^7.2`，推荐版本使用`7.3.*`。

网站以论坛的形式为玩家提供服务，实现了自动注册玩家账号及账号管理和密码找回等功能，可以自动从游戏源码中读取数据，展示游戏物品/怪物等资料及在线玩家排行榜。

演示地址：https://1000y.gameivy.com/

## 安装
    git clone git@github.com:oiuv/1000y.git
    cd 1000y
    composer install
    php artisan key:generate
    cp .env.example .env

你可以根据情况修改 .env 文件里的内容，如数据库连接、缓存、邮件设置等。

玩家登录数据库为windows服务器[SQL Server](https://www.microsoft.com/zh-cn/sql-server/sql-server-downloads)数据库，请根据游戏数据库说明配置，默认数据表为`account1000y`。

> 注意：php需打开[php_pdo_sqlsvr](https://docs.microsoft.com/zh-cn/sql/connect/php/download-drivers-php-sql-server?view=sql-server-2016)扩展

## 数据库迁移
    php artisan migrate --seed

##  游戏数据缓存
    php artisan 1000y:cache
