<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuario_f_link extends Model
{
    protected $fillable = ['user_id','link_id'];

    use HasFactory;
}
