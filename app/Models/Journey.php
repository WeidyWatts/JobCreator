<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journey extends Model
{
    protected $fillable = ['titulo'];
    use HasFactory;

    public function modulos() {
        return $this->hasMany(Modulo::class, 'journey_id');
    }
}
