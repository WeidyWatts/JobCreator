<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artigo_Modulo extends Model
{
    protected $fillable = ['modulo_id', 'artigo_id'];

    use HasFactory;
}
