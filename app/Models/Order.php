<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

    protected $primaryKey = 'idorder';
    protected $fillable = ['bayar', 'kembali', 'status'];
}
