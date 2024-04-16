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
        Schema::create('pre_purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable()->comment('日期');
            $table->string('no')->nullable()->comment('單號');
            $table->unsignedBigInteger('companies_id')->nullable()->comment('公司別');
            $table->nullableMorphs('sourceable');
            $table->string('name')->nullable()->comment('專案名稱');
            $table->unsignedBigInteger('staff_id')->nullable()->comment('人員');
            $table->unsignedBigInteger('departments_id')->nullable()->comment('部門');
            $table->unsignedBigInteger('make_id')->nullable()->comment('製單人員');
            $table->text('remark')->nullable()->comment('備註');
            $table->unsignedTinyInteger('pre_purchase_order_statuses_id')->default(1)->comment('狀態');
            $table->string('file')->nullable()->comment('附加檔案');
            $table->timestamps();
            $table->comment('請購單');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_purchase_orders');
    }
};
