<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journey_Usuario extends Model
{
    protected $fillable = ['user_id', 'journey_id', 'percentual_concluido'];
    use HasFactory;
}
