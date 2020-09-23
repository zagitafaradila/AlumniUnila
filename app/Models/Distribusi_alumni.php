<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distribusi_alumni extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['id','npm_alumni','npm_surveyor','status','catatan','prodi'];
    protected $casts = [
        'npm_alumni' => 'string',
        'npm_surveyor' => 'string',
    ];
}
