<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = "empresa";
    protected $connection = 'DB_CONNECTION_INVIAN';
    public $timestamps = false;

    public static function jerarquia($ruc)
    {
        return static::select('*')
            ->from('empresa as e')
            ->leftjoin('usuario as u', 'e.id', '=', 'u.id_empresa')
            ->leftjoin('usuariocategoria as uc', 'uc.id_usuario', '=', 'u.id')
            ->leftjoin('categoria as c', 'uc.id_categoria', '=', 'c.id')
            ->where('e.ruc', $ruc)
            ->get();
    }
}
