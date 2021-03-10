<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $primaryKey = 'idmenu';
    protected $fillable = ['idkategori', 'menu', 'gambar', 'harga'];
}
