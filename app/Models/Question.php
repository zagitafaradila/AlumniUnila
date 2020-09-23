<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['id','kode','kode_questioner','question','helptext','jenis'];
}
