<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function generos() {
        return $this->belongsToMany(Genero::class)->withPivot('relevancia');
    }

    public function modos() {
        return $this->belongsToMany(Modo::class)->withPivot('relevancia');
    }

    public function temas() {
        return $this->belongsToMany(Tema::class)->withPivot('relevancia');
    }

    public function perspectivas() {
        return $this->belongsToMany(Perspectiva::class)->withPivot('relevancia');
    }
}
