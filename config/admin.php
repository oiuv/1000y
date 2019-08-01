<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin name
    |--------------------------------------------------------------------------
    |
    | 登陆页面的大标题，显示在登陆页面
    |
    */
    'name' => '云端千年控制台',

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin logo
    |--------------------------------------------------------------------------
    |
    | 管理页面的logo设置，如果要设置为图片，可以设置为img标签
    | <img src="http://logo-url" alt="Admin logo">'.
    |
    */
    'logo' => '云端千年',

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin mini logo
    |--------------------------------------------------------------------------
    |
    | 当左侧边栏收起时显示的小logo，也可以设置为html标签
    |
    */
    'logo-mini' => '<b>云端</b>',

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin route settings
    |--------------------------------------------------------------------------
    |
    | 后台路由配置，应用在`app/Admin/routes.php`里面
    |
    */
    'route' => [

        'prefix' => 'admin',

        'namespace' => 'App\\Admin\\Controllers',

        'middleware' => ['web', 'admin'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin install directory
    |--------------------------------------------------------------------------
    |
    | 后台的安装目录，如果在运行`admin:install`之前修改它，那么后台目录将会是这个配置的目录
    |
    */
    'directory' => app_path('Admin'),

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin html title
    |--------------------------------------------------------------------------
    |
    | 所有页面的<title>标签内容
    |
    */
    'title' => '云端千年',

    /*
    |--------------------------------------------------------------------------
    | Access via `https`
    |--------------------------------------------------------------------------
    |
    | 后台是否使用https
    |
    */
    'https' => env('ADMIN_HTTPS', false),

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin auth setting
    |--------------------------------------------------------------------------
    |
    | 后台用户使用的用户认证配置
    |
    */
    'auth' => [

        'controller' => App\Admin\Controllers\AuthController::class,

        'guards' => [
            'admin' => [
                'driver'   => 'session',
                'provider' => 'admin',
            ],
        ],

        'providers' => [
            'admin' => [
                'driver' => 'eloquent',
                'model'  => Encore\Admin\Auth\Database\Administrator::class,
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin upload setting
    |--------------------------------------------------------------------------
    |
    | 在Form表单中的image和file类型的默认上传磁盘和目录设置，其中disk的配置会使用在
    | config/filesystem.php里面配置的一项disk
    |
    */
    'upload' => [

        // `config/filesystem.php`中设置的disk
        'disk' => 'public',

        // image和file类型表单元素的上传目录
        'directory' => [
            'image' => 'images',
            'file'  => 'files',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel-admin database settings
    |--------------------------------------------------------------------------
    |
    | 安装laravel-admin之后，默认会在数据库中新建下面9张表，包括用户、菜单、角色、权限、
    | 日志和它们之间的关系表，下面的配置是标的名字和对应的模型
    |
    | 其中的`connection`配置为下面几个模型所使用的数据库连接，对应`config/database.php`
    | 中的connections里面设置的connection,
    |
    | 如果你想修改数据库里面这几个表的名字，可以在运行`admin:install`之前修改它们
    | 如果install之后想修改，那么可以手动在数据库中修改，然后再修改下面几项的值
    |
    | 如果你需要在表里面增加字段，可以自定义模型，然后替换掉下面的模型设置即可，控制器的修改
    | 也可以通过覆盖路由的方式、覆盖掉内置的路由配置
    |
    */
    'database' => [

        // Database connection for following tables.
        'connection' => 'mysql',

        // User tables and model.
        'users_table' => 'admin_users',
        'users_model' => Encore\Admin\Auth\Database\Administrator::class,

        // Role table and model.
        'roles_table' => 'admin_roles',
        'roles_model' => Encore\Admin\Auth\Database\Role::class,

        // Permission table and model.
        'permissions_table' => 'admin_permissions',
        'permissions_model' => Encore\Admin\Auth\Database\Permission::class,

        // Menu table and model.
        'menu_table' => 'admin_menu',
        'menu_model' => Encore\Admin\Auth\Database\Menu::class,

        // Pivot table for table above.
        'operation_log_table'    => 'admin_operation_log',
        'user_permissions_table' => 'admin_user_permissions',
        'role_users_table'       => 'admin_role_users',
        'role_permissions_table' => 'admin_role_permissions',
        'role_menu_table'        => 'admin_role_menu',
    ],

    /*
    |--------------------------------------------------------------------------
    | User operation log setting
    |--------------------------------------------------------------------------
    |
    | 操作日志记录的配置
    |
    */
    'operation_log' => [

        // 是否开启日志记录、默认打开
        'enable' => true,

        /*
         * 允许记录请求日志的HTTP方法
         */
        'allowed_methods' => ['GET', 'HEAD', 'POST', 'PUT', 'DELETE', 'CONNECT', 'OPTIONS', 'TRACE', 'PATCH'],

        /*
         * 不需要被记录日志的url路径
         */
        'except' => [
            'admin/auth/logs*',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin map field provider
    |--------------------------------------------------------------------------
    |
    | model-form中map组件所使用的地图配置，支持三个地图服务商: "tencent", "google", "yandex".
    |
    */
    'map_provider' => 'google',

    /*
    |--------------------------------------------------------------------------
    | Application Skin
    |--------------------------------------------------------------------------
    |
    | 皮肤设置，参考https://adminlte.io/docs/2.4/layout设置
    |
    | 支持的设置为:
    |    "skin-blue", "skin-blue-light", "skin-yellow", "skin-yellow-light",
    |    "skin-green", "skin-green-light", "skin-purple", "skin-purple-light",
    |    "skin-red", "skin-red-light", "skin-black", "skin-black-light".
    |
    */
    'skin' => 'skin-purple',

    /*
    |--------------------------------------------------------------------------
    | Application layout
    |--------------------------------------------------------------------------
    |
    | 布局设置，参考https://adminlte.io/docs/2.4/layout
    |
    | 支持的设置为: "fixed", "layout-boxed", "layout-top-nav", "sidebar-collapse",
    | "sidebar-mini".
    |
    */
    'layout' => ['sidebar-mini', 'sidebar-collapse'],

    /*
    |--------------------------------------------------------------------------
    | Login page background image
    |--------------------------------------------------------------------------
    |
    | 登录页面的背景图设置
    |
    */
    'login_background_image' => '',

    /*
    |--------------------------------------------------------------------------
    | Show version at footer
    |--------------------------------------------------------------------------
    |
    | 是否在页面的右下角显示当前laravel-admin的版本
    |
    */
    'show_version' => true,

    /*
    |--------------------------------------------------------------------------
    | Show environment at footer
    |--------------------------------------------------------------------------
    |
    | 是否在页面的右下角显示当前的环境
    |
    */
    'show_environment' => true,

    /*
    |--------------------------------------------------------------------------
    | Menu bind to permission
    |--------------------------------------------------------------------------
    |
    | 菜单是否绑定权限
    */
    'menu_bind_permission' => true,

    /*
    |--------------------------------------------------------------------------
    | Enable default breadcrumb
    |--------------------------------------------------------------------------
    |
    | 是否开启页面的面包屑导航
    */
    'enable_default_breadcrumb' => true,

    /*
    |--------------------------------------------------------------------------
    | Extension Directory
    |--------------------------------------------------------------------------
    |
    | 如果你要运行`php artisan admin:extend`命令来开发扩展，需要配置这一项，来存放你的扩展文件
    */
    'extension_dir' => app_path('Admin/Extensions'),

    /*
    |--------------------------------------------------------------------------
    | Settings for extensions.
    |--------------------------------------------------------------------------
    |
    | 每一个laravel-admin扩展对应的配置，都写在这下面，扩展可以参考 https://github.com/laravel-admin-extensions
    |
    */
    'extensions' => [
        'summernote' => [
        
            //Set to false if you want to disable this extension
            'enable' => true,
            
            // Editor configuration
            'config' => [
                'lang'   => 'zh-CN',
                'height' => 300,
            ]
        ]
    ],
];
