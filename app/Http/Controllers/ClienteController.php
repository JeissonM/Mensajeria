<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;
use App\Http\Requests\ClienteRequest;
use PDF;

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

    /*
     * Genera listado de clientes en PDF
     */

    public function pdf() {
        $clientes = Cliente::all();
        if (count($clientes) > 0) {
            $array = null;
            foreach ($clientes as $c) {
                $array[] = [
                    'identificacion' => $c->identificacion,
                    'cliente' => $c->nombres . " " . $c->apellidos,
                    'correo' => $c->email,
                    'telefono' => $c->telefono,
                    'direccion' => $c->direccion
                ];
            }
            $encabezado = null;
            $cabeceras = ['IDENTIFICACIÓN', 'CLIENTE', 'CORREO', 'TELÉFONO', 'DIRECCIÓN'];
            $hoy = getdate();
            $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
            $date['fecha'] = $fecha;
            $date['encabezado'] = $encabezado;
            $date['cabeceras'] = $cabeceras;
            $date['data'] = $array;
            $date['nivel'] = 1;
            $date['titulo'] = "LISTADO GENERAL DE CLIENTES";
            $date['filtros'] = null;
            $pdf = PDF::loadView('print_1_2_niveles', $date);
            return $pdf->stream('reporte.pdf');
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function consultarpdf($campo, $valor) {
        $clientes = Cliente::where($campo, 'LIKE', '%' . $valor . '%')->get();
        if (count($clientes) > 0) {
            $array = null;
            foreach ($clientes as $c) {
                $array[] = [
                    'identificacion' => $c->identificacion,
                    'cliente' => $c->nombres . " " . $c->apellidos,
                    'correo' => $c->email,
                    'telefono' => $c->telefono,
                    'direccion' => $c->direccion
                ];
            }
            $encabezado = [
                'CONSULTA REALIZADA POR EL CAMPO' => $campo,
                'CON EL VALOR' => $valor
            ];
            $cabeceras = ['IDENTIFICACIÓN', 'CLIENTE', 'CORREO', 'TELÉFONO', 'DIRECCIÓN'];
            $hoy = getdate();
            $fecha = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
            $date['fecha'] = $fecha;
            $date['encabezado'] = $encabezado;
            $date['cabeceras'] = $cabeceras;
            $date['data'] = $array;
            $date['nivel'] = 1;
            $date['titulo'] = "LISTADO GENERAL DE CLIENTES";
            $date['filtros'] = null;
            $pdf = PDF::loadView('print_1_2_niveles', $date);
            return $pdf->stream('reporte.pdf');
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

}
