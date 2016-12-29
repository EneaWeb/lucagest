<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{

    protected $table = 'order_details';
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'order_id',
        'area_id',
        'name',
        'supplier_price',
        'total_price'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * Relations
     */
     
     public function order()
     {
         return $this->belongsTo('\App\Order');
     }

     public function area()
     {
         return $this->belongsTo('\App\Area');
     }
}
