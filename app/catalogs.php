<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalogs extends Model
{
    //
    protected $table = 'catalog';

    public function Goods() {
        return
            $this->belongsToMany(
                'App\Goods',
                'goods_catalogs',
                'id_catalog',
                'id'
            )->withPivot('id');
    }
}
