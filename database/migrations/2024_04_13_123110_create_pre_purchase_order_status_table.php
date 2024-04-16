<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
        Schema::create('pre_purchase_order_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->comment('請購單狀態');
        });

        foreach ($this->data as $value) {
            \Cpkm\ErpStock\Models\Restock\PrePurchaseOrderStatus::create($value);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_purchase_order_statuses');
    }
};
