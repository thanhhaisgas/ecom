<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $table='images';
    protected $fillable = ['id','url','product_id'];
    public $timestamps = false;
    public function product(){
        return $this->belongsTo('App\Product');
    }
}
