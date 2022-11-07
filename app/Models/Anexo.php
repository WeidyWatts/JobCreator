<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anexo extends Model
{
    protected $fillable = ['titulo','arquivo_anexo'];
    use HasFactory;
}
