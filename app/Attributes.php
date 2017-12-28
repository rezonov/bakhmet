<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attributes extends Model
{
    //
    protected $table = 'attributes';

    public function goods() {
        return $this->belongsToMany('App\Goods', 'goods_attributes')->withPivot('id');
    }
}
