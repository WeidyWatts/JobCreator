<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teste extends Model
{
   protected $fillable = ['titulo', 'descricao', 'link'];
    use HasFactory;
}
