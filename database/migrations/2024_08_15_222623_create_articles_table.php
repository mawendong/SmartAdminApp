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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');//标题
            $table->integer('types_id')->default(1);//所属类型，默认为1
            $table->integer('users_id')->default(1);//所属用户，默认为1
            $table->string('keywords');//关键词
            $table->string('description');//描述
            $table->text('content');//内容
            $table->string('author')->nullable();//作者，可为空
            $table->string('source')->nullable();//来源，可为空
            $table->string('cover')->nullable();//封面，可为空
            $table->integer('status')->default(0);//状态，默认为0
            $table->integer('views')->default(0);//浏览量，默认为0
            $table->integer('likes')->default(0);//点赞数，默认为0
            $table->timestamps();//创建时间
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
