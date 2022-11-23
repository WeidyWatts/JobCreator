<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anexo_Modulo extends Model
{
    protected $fillable = ['modulo_id', 'anexo_id'];
    use HasFactory;
}
