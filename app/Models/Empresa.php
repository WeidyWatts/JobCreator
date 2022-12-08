<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Empresa extends Model
{
    protected $fillable = ['nome_empresa','cnpj', 'user_id', 'status'];
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class, 'colaborador__empresas','empresa_id', 'user_id');
    }
}
