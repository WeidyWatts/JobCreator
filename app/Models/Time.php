<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Time extends Model
{
    protected $fillable=['nome'];
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class, 'usuario_times','time_id', 'user_id')->withPivot(['gerente']);;
    }
}
