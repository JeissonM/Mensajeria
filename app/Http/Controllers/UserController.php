<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $c = User::find($id);
        foreach ($c->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $c->$key = $request->$key;
            }
        }
        $c->nombres = strtoupper($c->nombres);
        $c->apellidos = strtoupper($c->apellidos);
        $result = $c->save();
        if ($result) {
            flash("El usuario <strong>" . $c->nombres . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('home');
        } else {
            flash("El usuarios <strong>" . $c->nombres . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('home');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, $id) {
        $c = User::find($id);
        $c->password = Hash::make($request->password);
        $result = $c->save();
        if ($result) {
            flash("La contraseña del usuario <strong>" . $c->nombres . "</strong> fue modificada de forma exitosa!")->success();
            return redirect()->route('home');
        } else {
            flash("La contraseña del usuario <strong>" . $c->nombres . "</strong> no pudo ser modificada. Error: " . $result)->error();
            return redirect()->route('home');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
