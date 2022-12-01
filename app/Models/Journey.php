<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journey extends Model
{
    protected $fillable = ['titulo'];
    use HasFactory;

    public function modulos() {
        return $this->hasMany(Modulo::class, 'journey_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'journey__usuarios','journey_id', 'user_id')->withPivot(['percentual_concluido']);
    }
}
