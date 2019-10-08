@extends('layouts.admin')
@section('content')
<div class="page-title">
    <div>
        <h1>Resultados de la Consulta</h1>
        <ul class="breadcrumb side">
            <li><a href="{{route('home')}}"><i class="fa fa-home fa-lg"></i> Inicio</a></li>
            <li><a href="{{route('cliente.consulta')}}"><i class="fa fa-search fa-lg"></i> Consulta de Clientes</a></li>
            <li class="active"><a>Resultados de la Consulta</a></li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        @include('flash::message')
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>{{count($clientes)}} resultados encontrados para busqueda por {{$campo}}={{$valor}}...</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover table-bordered table-striped" id="sampleTable">
                    <thead>
                        <tr class="info">
                            <th>IDENTIFICACIÓN</th>
                            <th>CLIENTE</th>
                            <th>CORREO</th>
                            <th>TELÉFONO</th>
                            <th>DIRECCIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientes as $c)
                        <tr>
                            <td>{{$c->identificacion}}</td>
                            <td>{{$c->nombres." ".$c->apellidos}}</td>
                            <td>{{$c->email}}</td>
                            <td>{{$c->telefono}}</td>
                            <td>{{$c->direccion}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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