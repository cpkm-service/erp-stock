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
        Schema::create('pre_purchase_order_items', function (Blueprint $table) {
            $table->id();
            $table->morphs('sourceable');
            $table->unsignedBigInteger('products_id')->comment('產品編號');
            $table->unsignedBigInteger('count')->default(0)->comment('請購數量');
            $table->unsignedBigInteger('stock')->default(0)->comment('庫存數量');
            $table->date('need_date')->nullable()->comment('需求日期');
            $table->unsignedBigInteger('pre_count')->default(0)->comment('預採數量');
            $table->unsignedBigInteger('factory_id')->nullable()->comment('廠商id');
            $table->text('description')->nullable()->comment('內部描述');
            $table->text('remark')->nullable()->comment('備註');
            $table->string('file')->nullable()->comment('附加檔案');
            $table->timestamps();
            $table->comment('請購單項目');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_purchase_order_items');
    }
};
