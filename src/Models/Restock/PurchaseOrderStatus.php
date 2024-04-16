<?php

namespace Cpkm\ErpStock\Models\Restock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderStatus extends Model
{
    use HasFactory, \App\Traits\QueryTrait;

    protected $fillable = [
        'name',
    ];

    public static $audit = [
        //要紀錄欄位
        'only' => [
            'name',
        ],
    ];
    
    /** 
     * @access protected
     * @var detail
     * @version 1.0
     * @author Henry
    **/
    protected $detail = [
        'id',
        'name',
    ];


    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
