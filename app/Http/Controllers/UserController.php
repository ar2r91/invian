<?php

namespace App\Http\Controllers;

use App\User;
use App\UsuarioCategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function list()
    {
        $usuarios = User::all();
        return json_encode($usuarios);
    }

    public function listusuariocategoria()
    {
        $usuarios = User::categorias();
        return json_encode($usuarios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $usuario = new User();
            $usuario->nombres = $request->nombres;
            $usuario->apellidos = $request->apellidos;
            $usuario->dni = $request->dni;
            $usuario->id_empresa = $request->empresa;

            DB::transaction(function () use ($usuario, $request) {
                $usuario->save();
                $this->UsuarioCategoria($usuario->id, $request);
            });

            $r["estado"] = "ok";
            $r["mensaje"] = "Grabado Correctamente";

        } catch (PDOException $e) {
            $r["estado"] = "error";
            $r["mensaje"] = "Error al Grabar!";
            $r["error"] = $e->getMessage();
        }

        return json_encode($r);
    }

    private function UsuarioCategoria($id_user, $request)
    {
        $categoria = $request->categoria;//arreglo de categorias asignadas al usuario
        for ($i = 0; $i < count($categoria); $i++) {
            $usucat = new UsuarioCategoria();
            $usucat->id_cat = $categoria[$i];
            $usucat->id_usuario = $id_user;
            $usucat->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::findOrFail($id);

        return json_encode($usuario);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //No pidieron update, asi que solo contemple el registrar
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
