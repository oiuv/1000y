<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccount1000yTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('1000y')->create('account1000y', function (Blueprint $table) {
            $table->increments('id');

            $table->string('account', 20)->unique();
            $table->string('password', 20);

            $table->string('char1', 50)->nullable();
            $table->string('char2', 50)->nullable();
            $table->string('char3', 50)->nullable();
            $table->string('char4', 50)->nullable();
            $table->string('char5', 50)->nullable();

            $table->string('ipaddr', 20)->nullable();
            $table->string('username', 20)->nullable();
            $table->string('birth', 20)->nullable();
            $table->string('telephone', 20)->nullable();
            $table->string('makedate', 50)->nullable();
            $table->string('lastdate', 50)->nullable();
            $table->string('address', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('nativenumber', 20)->nullable();
            $table->string('masterkey', 20)->nullable();
            $table->string('ptname', 20)->nullable();
            $table->string('ptnativenumber', 20)->nullable();

            $table->string('avatar', 255)->nullable();
            $table->string('introduction', 255)->nullable();
            $table->integer('notification_count')->nullable();
            $table->string('remember_token', 255)->nullable();
            $table->dateTime('updated_at')->nullable();

            $table->index('account');
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('1000y')->dropIfExists('account1000y');
    }
}