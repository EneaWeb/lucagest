<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    protected $table = 'services';
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'area_id'
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

    public function order_details()
    {
        return $this->hasMany('\App\OrderDetail');
    }
    
    public function ordersCount()
    {
        return \App\OrderDetail::where('service_id', $this->id)->groupBy('order_id')->count();
    }

    public function area()
    {
        return $this->belongsTo('\App\Area');
    }

}
