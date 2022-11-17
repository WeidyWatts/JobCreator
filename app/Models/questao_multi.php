<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class questao_multi extends Model
{
    protected $fillable = ['enunciado', 'teste_id'];
    use HasFactory;


    public function opcoes()
    {
        return $this->hasMany(opcao_multi::class, 'questao_id');
    }
}
