<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colaborador_Empresa extends Model
{
    protected $fillable = ['empresa_id', 'user_id'];
    use HasFactory;





}
