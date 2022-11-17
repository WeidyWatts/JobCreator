<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class questao_texto extends Model
{
    protected $fillable = ['enunciado', 'resposta', 'teste_id'];
    use HasFactory;
}
