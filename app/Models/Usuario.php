<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'rol',
    ];

    protected $hidden = ['password'];

    protected static function booted()
    {
        static::creating(function ($usuario) {
            $nextId = \DB::select("SELECT SEQ_USUARIO.NEXTVAL AS ID FROM DUAL")[0]->id;
            $usuario->id_usuario = $nextId;
        });
    }
}
