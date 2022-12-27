<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    protected $fillable = ['notificacao', 'user_id', 'status'];
    use HasFactory;
}
