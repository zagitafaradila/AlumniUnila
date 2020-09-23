<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $primaryKey = 'npm';
    protected $fillable = ['npm','name','birthday','fak','jur','prodi','telp','wisuda','registered','active'];
    protected $casts = [
        'npm' => 'string',
    ];
}
