<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuario_f_artigo extends Model
{
    protected $fillable = ['user_id','artigo_id'];

    use HasFactory;
}
