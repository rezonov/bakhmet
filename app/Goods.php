<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //
    protected $table = 'goods';

    public function attrbutes() {
        return $this->belongsToMany('App\Attributes', 'goods_attributes')->withPivot('id');
    }
}
