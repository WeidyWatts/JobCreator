<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teste_Modulo extends Model
{
    protected $fillable = ['modulo_id', 'teste_id'];

    use HasFactory;
}
