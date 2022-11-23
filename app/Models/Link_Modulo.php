<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link_Modulo extends Model
{
    protected $fillable = ['modulo_id', 'link_id'];

    use HasFactory;
}
