<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{

    protected $table = 'options';
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'value'
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

    public static function showSupplierPrices()
    {
        return ( \App\Option::where('name', 'hide_supplier_prices')->value('value') == '0' );
    }

    public static function hideSupplierPrices()
    {
        return ( \App\Option::where('name', 'hide_supplier_prices')->value('value') == '1' );
    }

}
