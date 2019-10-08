@extends('layouts.admin')

@section('content')
<div class="row user">
    <div class="col-md-12">
        <div class="profile">
            <div class="info"><img class="user-img" src="{{asset('images/user.png')}}">
                <h4>{{Auth::user()->nombres." ".Auth::user()->apellidos}}</h4>
                <p>ADMINISTRADOR</p>
            </div>
            <div class="cover-image"></div>
        </div>
    </div>
    <div class="col-md-12" style="margin-top: 30px">
        @include('flash::message')
    </div>
    <div class="col-md-12">
        <div class="col-md-3">
            <div class="card p-0">
                <ul class="nav nav-tabs nav-stacked user-tabs">
                    <li class="active"><a href="#user-timeline" data-toggle="tab"> Información Personal</a></li>
                    <li><a href="#user-settings" data-toggle="tab"> Actualizar Información</a></li>
                    <li><a href="#user-password" data-toggle="tab"> Cambiar Contraseña</a></li>
                </ul>
            </div>
            <div class="widget-small danger"><i class="icon fa fa-user fa-3x"></i>
                <div class="info">
                    <h4>Total Clientes</h4>
                    <p><b>{{$i}}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane active" id="user-timeline">
                    <div class="timeline">
                        <div class="post">
                            <div class="bs-component">
                                <ul class="list-group">
                                    <li class="list-group-item"><span class="badge">IDENTIFICACIÓN</span>{{$c->identificacion}}</li>
                                    <li class="list-group-item"><span class="badge">USUARIO</span>{{$c->nombres." ".$c->apellidos}}</li>
                                    <li class="list-group-item"><span class="badge">ESTADO</span>@if($c->estado=='ACTIVO')<i class="label-success">{{$c->estado}}</i>@else<i class="label-danger">{{$c->estado}}</i>@endif</li>
                                    <li class="list-group-item"><span class="badge">CORREO ELECTRÓNICO</span>{{$c->email}}</li>
                                    <li class="list-group-item"><span class="badge">EN EL SISTEMA DESDE</span>{{$c->created_at}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="user-settings">
                    <div class="card user-settings">
                        <h4 class="line-head">Actualizar Información</h4>
                        <div class="row">
                            <form method="POST" action="{{route('user.update',$c)}}">
                                @csrf
                                <input name="_method" type="hidden" value="PUT"/>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label class="control-label">Identificación</label>
                                        <input class="form-control" type="text" value="{{$c->identificacion}}" name="identificacion" required="">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Nombres</label>
                                        <input class="form-control" value="{{$c->nombres}}" type="text" name="nombres" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label class="control-label">Apellidos</label>
                                        <input class="form-control" value="{{$c->apellidos}}" type="text" required="" name="apellidos">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label">Correo Electrónico</label>
                                        <input class="form-control" value="{{$c->email}}" type="email" required="" name="email">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label">Estado</label>
                                        <select class="form-control" name="estado">
                                            @if($c->estado=='ACTIVO')
                                            <option selected="" value="ACTIVO">ACTIVO</option>
                                            <option value="INACTIVO">INACTIVO</option>
                                            @else
                                            <option value="ACTIVO">ACTIVO</option>
                                            <option selected="" value="INACTIVO">INACTIVO</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12" style="margin-top: 50px">
                                        <button class="btn btn-primary icon-btn" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>GUARDAR</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="user-password">
                    <div class="card user-settings">
                        <h4 class="line-head">Actualizar Contraseña</h4>
                        <div class="row">
                            <form method="POST" action="{{route('user.updatePassword',$c)}}">
                                @csrf
                                <input name="_method" type="hidden" value="PUT"/>
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label class="control-label">Identificación</label>
                                        <input class="form-control" type="text" value="{{$c->identificacion}}" readonly="" name="identificacion">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label">Nombres</label>
                                        <input class="form-control" value="{{$c->nombres}}" readonly="" type="text" name="nombres">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label">Apellidos</label>
                                        <input class="form-control" value="{{$c->apellidos}}" readonly="" type="text" name="apellidos">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label">Contraseña Nueva</label>
                                        <input class="form-control" type="password" name="password" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12" style="margin-top: 50px">
                                        <button class="btn btn-primary icon-btn" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>GUARDAR</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
