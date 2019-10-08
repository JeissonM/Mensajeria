@extends('layouts.admin')
@section('content')
<div class="page-title">
    <div>
        <h1>Editar Cliente</h1>
        <ul class="breadcrumb side">
            <li><a href="{{route('home')}}"><i class="fa fa-home fa-lg"></i> Inicio</a></li>
            <li><a href="{{route('cliente.index')}}"><i class="fa fa-user fa-lg"></i> Clientes</a></li>
            <li class="active"><a>Editar Cliente</a></li>
        </ul>
    </div>
    <div><a class="btn btn-info btn-flat" href="{{route('cliente.index')}}"><i class="fa fa-lg fa-mail-reply"></i></a></div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <h3 class="card-title">Datos del Cliente</h3>
            <div class="card-body">
                <div class="col-md-12">
                    @component('layouts.errors')
                    @endcomponent
                </div>
                <div class="row">
                    <form method="POST" action="{{route('cliente.update',$c)}}">
                        @csrf
                        <input name="_method" type="hidden" value="PUT"/>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label class="control-label">Identificación (Opcional)</label>
                                <input class="form-control" type="text" value="{{$c->identificacion}}" name="identificacion">
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Nombres</label>
                                <input class="form-control" type="text" value="{{$c->nombres}}" name="nombres" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label class="control-label">Apellidos</label>
                                <input class="form-control" type="text" value="{{$c->apellidos}}" name="apellidos"  required="">
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Teléfono</label>
                                <input class="form-control" value="{{$c->telefono}}" type="text" name="telefono" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label class="control-label">Correo Electrónico (Opcional)</label>
                                <input class="form-control" value="{{$c->email}}" type="email" name="email">
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Dirección de Residencia</label>
                                <input class="form-control" value="{{$c->direccion}}" type="text" name="direccion" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12" style="margin-top: 50px">
                                <button class="btn btn-primary icon-btn" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>GUARDAR</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-default icon-btn" href="{{route('cliente.index')}}"><i class="fa fa-fw fa-lg fa-mail-reply"></i>Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">

</script>
@endsection