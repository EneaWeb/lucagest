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
        'service_id',
        'price'
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

     public function service()
     {
         return $this->belongsTo('\App\Service');
     }
     
     public function order()
     {
         return $this->belongsTo('\App\Order');
     }
}
