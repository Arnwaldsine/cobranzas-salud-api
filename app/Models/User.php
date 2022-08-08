<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'foto',
        'bio',
        'email',
        'password',
        'punto_venta_id'
    ];
    protected $with = [
        'puntoVenta'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function gestiones(){
        return $this->hasMany(Gestion::class,'user-id','id');
    }
    public function puntoVenta(){
        return $this->belongsTo(PuntoVenta::class,'punto_venta_id','id');
    }
    public function nombreCompleto(){
        return $this->nombre.' '.$this->apellido;
    }
}
