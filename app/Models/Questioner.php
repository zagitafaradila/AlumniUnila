<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questioner extends Model
{
    protected $primaryKey = 'kode';
    protected $fillable = ['kode','nama','kategori','for','active'];
    protected $casts = [
        'kode' => 'string',
    ];
}
