# [云端千年](https://1000y.gameivy.com)

云端千年是一个怀旧千年游戏公益服务器，免费娱乐，欢迎来云端千年游戏，交流QQ群：`2887111`。你也可以使用[云端千年源码](https://github.com/oiuv/1000yTGS)架设自己的游戏服务器。

    本网站源码运行环境为windows服务器mssql数据库。

## 安装
    git clone git@github.com:oiuv/1000y.git
    cd 1000y
    composer install
    php artisan key:generate
    cp .env.example .env

你可以根据情况修改 .env 文件里的内容，如数据库连接、缓存、邮件设置等。

## 数据库迁移
    php artisan migrate --seed

##  游戏数据缓存
    php artisan 1000y:cache
