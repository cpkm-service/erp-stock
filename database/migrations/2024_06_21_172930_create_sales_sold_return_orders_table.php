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
        Schema::create('sales_sold_return_orders', function (Blueprint $table) {
            $table->id();
            $table->date('date')->comment('日期');
            $table->string('no')->comment('單號');
            $table->unsignedBigInteger('companies_id')->comment('公司別');
            $table->unsignedBigInteger('customers_id')->comment('客戶');
            $table->nullableMorphs('sourceable');
            $table->unsignedBigInteger('customer_contacts_id')->nullable()->comment('客戶聯絡人');
            $table->unsignedBigInteger('customer_staff_id')->nullable()->comment('客戶業務人員');
            $table->string('customer_address')->nullable()->comment('客戶地址');
            $table->string('customer_phone')->nullable()->comment('客戶電話');
            $table->string('name')->nullable()->comment('專案名稱');
            $table->unsignedBigInteger('project_managements_id')->nullable()->comment('專案');
            $table->date('delivery_date')->nullable()->comment('預定交貨日期');
            $table->unsignedBigInteger('invoice_types_id')->comment('發票金額');
            $table->unsignedBigInteger('invoice_methods_id')->comment('發票方式');
            $table->unsignedBigInteger('invoice_categories_id')->comment('發票聯式');
            $table->unsignedBigInteger('currencies_id')->comment('客戶幣別');
            $table->decimal('exchange', 16, 8)->default(0)->comment('匯率');
            $table->unsignedBigInteger('staff_id')->nullable()->comment('人員');
            $table->unsignedBigInteger('departments_id')->nullable()->comment('部門');
            $table->unsignedBigInteger('make_id')->nullable()->comment('製單人員');
            $table->decimal('amount', 16, 4)->default(0)->comment('未稅金額');
            $table->decimal('tax', 16, 4)->default(0)->comment('稅金');
            $table->decimal('total_amount', 16, 4)->default(0)->comment('總金額');
            $table->string('file')->nullable()->comment('附加檔案');
            $table->decimal('main_amount', 16, 4)->default(0)->comment('未稅金額(本位幣)');
            $table->decimal('main_tax', 16, 4)->default(0)->comment('稅金(本位幣)');
            $table->decimal('main_total_amount', 16, 4)->default(0)->comment('總金額(本位幣)');
            $table->text('remark')->nullable()->comment('備註');
            $table->string('invoice')->nullable()->comment('發票號碼');
            $table->unsignedTinyInteger('sales_sold_return_order_statuses_id')->default(1)->comment('狀態');
            $table->timestamps();
            $table->comment('銷貨退回單');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_sold_return_orders');
    }
};
