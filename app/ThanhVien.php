<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThanhVien extends Model
{
    //
    protected $table = 'ThanhVien';
    protected $filltable = ['email','password','level'];
    public $timestamps = false;
}
