<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class opcao_multi extends Model
{
    protected $fillable = ['opcao', 'is_correct', 'questao_id'];
    use HasFactory;




}
