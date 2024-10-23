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
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('title');//标题
            $table->integer('parent_id')->default(1);//类型，默认为0
            $table->integer('sort')->default(1);//排序，默认为1
            $table->string('description')->nullable();//描述，可为空
            $table->string('icon')->nullable();//图标，可为空
            $table->timestamps(); //创建时间戳字段（created_at 和 updated_at）
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('types');
    }
};
