<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //category object include 3 properties: name, status, parent_id.
    protected $table = 'categories';
    protected $fillable = ['name','status','parent_id'];
    public $timestamps = false; 

    
}
