<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('articles', function (Blueprint $table) {
        $table->string('url')->nullable()->change(); // null 許容に変更
    });
}

public function down()
{
    Schema::table('articles', function (Blueprint $table) {
        $table->string('url')->nullable(false)->change(); // 元に戻す
    });
}

};
