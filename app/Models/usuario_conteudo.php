<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuario_conteudo extends Model
{
    protected $fillable = ['ju_id', 'modulo_id', 'conteudo_table', 'conteudo_id', 'status' ];
    use HasFactory;
}
