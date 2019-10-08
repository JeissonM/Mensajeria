<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;
use App\Http\Requests\ClienteRequest;

class ClienteController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $clientes = Cliente::all();
        return view('clientes.list')
                        ->with('location', 'cliente')
                        ->with('clientes', $clientes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('clientes.create')
                        ->with('location', 'cliente');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteRequest $request) {
        $c = New Cliente($request->all());
        foreach ($c->attributesToArray() as $key => $value) {
            if ($key == "email") {
                $c->$key = $value;
            } else {
                $c->$key = strtoupper($value);
            }
        }
        $result = $c->save();
        if ($result) {
            flash("El cliente <strong>" . $c->nombres . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('cliente.index');
        } else {
            flash("El cliente <strong>" . $c->nombres . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('cliente.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $c = Cliente::find($id);
        return view('clientes.edit')
                        ->with('location', 'cliente')
                        ->with('c', $c);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $c = Cliente::find($id);
        foreach ($c->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                if ($key == 'email') {
                    $c->$key = $request->$key;
                } else {
                    $c->$key = strtoupper($request->$key);
                }
            }
        }
        $result = $c->save();
        if ($result) {
            flash("El cliente <strong>" . $c->nombres . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('cliente.index');
        } else {
            flash("El cliente <strong>" . $c->nombres . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('cliente.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $c = Cliente::find($id);
        $result = $c->delete();
        if ($result) {
            flash("El cliente <strong>" . $c->nombres . "</strong> fue eliminado de forma exitosa!")->success();
            return redirect()->route('cliente.index');
        } else {
            flash("El cliente <strong>" . $c->nombres . "</strong> no pudo ser eliminado. Error: " . $result)->error();
            return redirect()->route('cliente.index');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function consulta() {
        return view('consulta.list')
                        ->with('location', 'consulta');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function consultar(Request $request) {
        $clientes = Cliente::where($request->campo, 'LIKE', '%' . $request->valor . '%')->get();
        return view('consulta.resultado')
                        ->with('location', 'consulta')
                        ->with('clientes', $clientes)
                        ->with('campo', $request->campo)
                        ->with('valor', $request->valor);
    }

}
