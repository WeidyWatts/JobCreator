<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario_time extends Model
{
    protected $fillable=['user_id', 'time_id'];
    use HasFactory;
}
