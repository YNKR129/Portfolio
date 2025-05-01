<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id'); // 紐づく記事
            $table->unsignedBigInteger('user_id')->nullable(); // コメントしたユーザー（ログイン機能があれば）
            $table->text('content'); // コメント本文
            $table->timestamps();
        
            // 外部キー制約（オプション）
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            // ログイン機能使うならこちらも
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
