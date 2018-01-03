<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attributes extends Model
{
    //
    protected $table = 'attributes';

    public function Goods() {
        return $this->belongsToMany(
            'App\Goods',
            'goods_attributes',
            'id_good',
            'id_good'
            )->withPivot('id');
    }
}
