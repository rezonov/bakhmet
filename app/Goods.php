<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //
    protected $table = 'goods';

    public function Attributes() {
        return $this->belongsToMany(
            'App\Attributes',
            'goods_attributes',
            'id_good',
            'id_good')
            ->withPivot('id');
    }
    public function Catalogs() {
        return $this->belongsToMany(
            'App\Catalogs',
            'goods_catalogs',
            'id_good',
            'id')
            ->withPivot('id');
    }
}
