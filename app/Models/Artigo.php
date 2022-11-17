<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artigo extends Model
{


    protected $fillable = ['titulo', 'link', 'autor', 'ano_publicacao'];

    use HasFactory;
}
