<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'orders';
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'customer_name', 
        'customer_contact',
        'payed'
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

     public function customer()
     {
         return $this->belongsTo('\App\Customer');
     }

     public function details()
     {
         return $this->hasMany('\App\OrderDetail');
     }

     public function supplierTotal()
     {
         $a = 0;
         foreach ($this->details as $detail) {
            $a += $detail->service->price;
         }
         return number_format($a, 2, ',', '.');
     }

     public function total()
     {
         $a = 0;
         foreach ($this->details as $detail) {
             $a += $detail->price;
         }
         return number_format($a, 2, ',', '.');
     }

}
