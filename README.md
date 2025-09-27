# [云端千年](https://1000y.gameivy.com)

云端千年是一个怀旧千年游戏公益服务器，免费娱乐，欢迎来云端千年游戏，交流QQ群：`2887111`。你也可以使用[云端千年源码](https://github.com/oiuv/1000yTGS)架设自己的游戏服务器。

项目基于Laravel 6.0开发，PHP版本要求`^7.2`，推荐版本使用`7.3.*|7.4.*`。

网站以论坛的形式为玩家提供服务，实现了自动注册玩家账号及账号管理和密码找回等功能，可以自动从游戏源码中读取数据，展示游戏物品/怪物等资料及在线玩家排行榜。

演示地址：https://1000y.gameivy.com/

## 安装

注意，网站支持windows/linux/macos环境，但如果不是在windows环境下，无法使用玩家数据排行功能。

    git clone git@github.com:oiuv/1000y.git
    cd 1000y
    composer install
    cp .env.example .env
    php artisan key:generate

你可以根据情况修改 .env 文件里的内容，如SQLSVR数据库连接、Redis缓存、短信发送接口、邮件发送设置等（相关配置对非专业人员来说相对复杂）。

玩家登录数据库为windows服务器[SQL Server](https://www.microsoft.com/zh-cn/sql-server/sql-server-downloads)数据库，请根据游戏数据库说明配置，默认数据表为`account1000y`。

> 玩家账号数据库字段参考：

```sql
CREATE TABLE "account1000y" (
	"id" INT identity(1,1) PRIMARY KEY,

	"account" VARCHAR(20) NOT NULL,
	"password" VARCHAR(20) NOT NULL,
	"char1" VARCHAR(50) NULL DEFAULT NULL,
	"char2" VARCHAR(50) NULL DEFAULT NULL,
	"char3" VARCHAR(50) NULL DEFAULT NULL,
	"char4" VARCHAR(50) NULL DEFAULT NULL,
	"char5" VARCHAR(50) NULL DEFAULT NULL,
	"ipaddr" VARCHAR(20) NULL DEFAULT NULL,
	"username" VARCHAR(20) NULL DEFAULT NULL,
	"birth" VARCHAR(20) NULL DEFAULT NULL,
	"telephone" VARCHAR(20) NULL DEFAULT NULL,
	"makedate" VARCHAR(50) NULL DEFAULT NULL,
	"lastdate" VARCHAR(50) NULL DEFAULT NULL,
	"address" VARCHAR(50) NULL DEFAULT NULL,
	"email" VARCHAR(50) NULL DEFAULT NULL,
	"nativenumber" VARCHAR(20) NULL DEFAULT NULL,
	"masterkey" VARCHAR(20) NULL DEFAULT NULL,
	"ptname" VARCHAR(20) NULL DEFAULT NULL,
	"ptnativenumber" VARCHAR(20) NULL DEFAULT NULL,

	"avatar" VARCHAR(255) NULL DEFAULT NULL,
	"introduction" VARCHAR(255) NULL DEFAULT NULL,
	"notification_count" INT NULL DEFAULT NULL,
	"remember_token" VARCHAR(255) NULL DEFAULT NULL,
	"updated_at" DATETIME NULL DEFAULT NULL
);
```

或者在现有数据库中执行以下SQL语句（推荐）：

```sql
ALTER TABLE
    [1000y].[dbo].[account1000y]
ADD
    "id" INT identity(1, 1),
    "avatar" VARCHAR(255) NULL DEFAULT NULL,
    "introduction" VARCHAR(255) NULL DEFAULT NULL,
    "remember_token" VARCHAR(255) NULL DEFAULT NULL,
    "notification_count" INT NULL DEFAULT NULL,
    "updated_at" DATETIME NULL DEFAULT NULL
```

> 注意：php需打开[php_pdo_sqlsvr](https://docs.microsoft.com/zh-cn/sql/connect/php/download-drivers-php-sql-server?view=sql-server-2016)扩展

## 数据库迁移

.env数据库相关配置完成后，运行以下指令创建网站数据表：

    php artisan migrate

注意：配置`UsersTableSeeder`指定网站管理员的ID后运行`php artisan migrate --seed`

##  游戏数据缓存

.env中配置`P_1000y_TGS`到你游戏TGS目录，配置`P_USER_DATA`到玩家存档目录(数据库程序目录下的Userdata目录)，运行以下指令缓存相关数据：

    php artisan 1000y:cache

> 注意生成物品图片需要`GD`库支持，否则会`ERROR: GD Library extension not available with this PHP installation.`

当数据缓存后网站即可显示内容，但玩家数据是每天更新的，如需自动更新网站排行榜，可在服务器配置一个计划任务在每天凌晨3:00以后自动执行缓存指令。

## 提示

因为源码主要是为云端千年服务，其它千年用来建站需要微调代码，如果你使用本站代码架设遇到困难，可付费申请技术支持（QQ：7300637）。
