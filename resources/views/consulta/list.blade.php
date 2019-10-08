@extends('layouts.admin')
@section('content')
<div class="page-title">
    <div>
        <h1>Consulta de Clientes</h1>
        <ul class="breadcrumb side">
            <li><a href="{{route('home')}}"><i class="fa fa-home fa-lg"></i> Inicio</a></li>
            <li class="active"><a>Consulta de Clientes</a></li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        @include('flash::message')
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <form method="POST" action="{{route('cliente.consultar')}}">
                        @csrf
                        <div class="form-group">
                            <div class="col-md-4">
                                <label class="control-label">Campo de Busqueda</label>
                                <select class="form-control" name="campo" required="">
                                    <option value="identificacion">BUSCAR POR IDENTIFICACIÓN</option>
                                    <option value="nombres">BUSCAR POR NOMBRES</option>
                                    <option value="apellidos">BUSCAR POR APELLIDOS</option>
                                    <option value="email">BUSCAR POR CORREO</option>
                                    <option value="telefono">BUSCAR POR TELÉFONO</option>
                                    <option value="direccion">BUSCAR POR DIRECCIÓN</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Valor de Busqueda</label>
                                <input class="form-control" type="text" name="valor" required="">
                            </div>
                            <div class="col-md-4" style="margin-top: 20px">
                                <button class="btn btn-primary btn-block icon-btn" type="submit"><i class="fa fa-fw fa-lg fa-search"></i> CONSULTAR</button>
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
    //$('#sampleTable').DataTable();
</script>
@endsection