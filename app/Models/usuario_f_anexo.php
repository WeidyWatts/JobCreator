<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuario_f_anexo extends Model
{
    protected $fillable = ['user_id','anexo_id'];

    use HasFactory;
}
