<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $table = 'customers';
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'second name', 
        'address', 
        'postcode', 
        'city', 
        'province', 
        'telephone', 
        'email'
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

     public function orders()
     {
         return $this->hasMany('\App\Order');
     }

}
