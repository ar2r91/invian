<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = "usuario";
    protected $connection = 'DB_CONNECTION_INVIAN';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa');
    }

    public static function categorias()
    {
        return static::select('u.*', 'uc.nombre')
            ->from('usuario as u')
            ->leftjoin('usuariocategoria as uc', 'uc.id_usuario', '=', 'u.id')
            ->leftjoin('categoria as c', 'uc.id_categoria', '=', 'c.id')
            ->get();
    }
}
