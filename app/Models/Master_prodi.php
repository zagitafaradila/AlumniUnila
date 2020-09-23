<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Master_prodi extends Model
{
    protected $primaryKey = 'kode';
    protected $fillable = ['kode','nama','urutan','active'];
}
