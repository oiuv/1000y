<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $categories = [
            [
                'name'        => '分享',
                'description' => '分享游戏技巧，分享更多快乐',
            ],
            [
                'name'        => '问答',
                'description' => '游戏有疑问？来这里互帮互助',
            ],
            [
                'name'        => '举报',
                'description' => '维护游戏秩序，净化游戏环境',
            ],
            [
                'name'        => '公告',
                'description' => '游戏公告，武林资讯',
            ],
        ];

        DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('categories')->truncate();
    }
}
