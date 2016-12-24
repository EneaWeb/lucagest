<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{

    protected $table = 'areas';
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name'
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

     public function services()
     {
         return $this->hasMany('\App\Service');
     }

}
