<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuarioCategoria extends Model
{
    protected $table = "usuariocategoria";
    protected $connection = 'DB_CONNECTION_INVIAN';
    public $timestamps = false;

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
