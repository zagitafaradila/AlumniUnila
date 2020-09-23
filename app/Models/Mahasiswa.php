<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $primaryKey = 'npm';
    protected $fillable = ['npm','name','birthday','fak','jur','prodi','telp','angkatan','registered','active'];
    protected $casts = [
        'npm' => 'string',
    ];
}
