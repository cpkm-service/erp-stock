<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Cpkm\ErpStock\Models\Sales\SoldReturnOrderStatus;

return new class extends Migration
{
    public $data = [
        [
            'id'    =>  1,
            'name'  => '未結案',
        ],
        [
            'id'    =>  2,
            'name'  => '結案',
        ],
        [
            'id'    =>  3,
            'name'  => '取消',
        ],
    ];
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales_sold_return_order_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('名稱');
            $table->timestamps();
            $table->comment('銷貨退回單狀態');
        });

        foreach ($this->data as $key => $value) {
            SoldReturnOrderStatus::create($value);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_sold_return_order_statuses');
    }
};
