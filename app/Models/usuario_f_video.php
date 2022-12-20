<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuario_f_video extends Model
{
    protected $fillable = ['user_id','video_id'];
    use HasFactory;
}
