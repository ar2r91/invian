<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

class EmpresaController extends Controller
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
        $empresas = Empresa::all();
        return json_encode($empresas);
    }

    public function listjeraquia($ruc)
    {
        $jerarquia = Empresa::jerarquia($ruc);
        return json_encode($jerarquia);
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
            $empresa = new Empresa();
            $empresa->razonsocial = $request->razonsocial;
            $empresa->ruc = $request->ruc;
            $empresa->direccion = $request->direccion;

            DB::transaction(function () use ($empresa) {
                $empresa->save();
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

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = Empresa::findOrFail($id);

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
