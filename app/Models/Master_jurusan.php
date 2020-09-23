<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Master_jurusan extends Model
{
    protected $primaryKey = 'kode';
    protected $fillable = ['kode','nama','urutan','active'];
}
