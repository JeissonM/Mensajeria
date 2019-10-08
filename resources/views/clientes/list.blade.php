@extends('layouts.admin')
@section('content')
<div class="page-title">
    <div>
        <h1>Gestión de Clientes</h1>
        <ul class="breadcrumb side">
            <li><a href="{{route('home')}}"><i class="fa fa-home fa-lg"></i> Inicio</a></li>
            <li class="active"><a>Gestión de Clientes</a></li>
        </ul>
    </div>
    <div>
        <a class="btn btn-info btn-flat" href="{{route('cliente.create')}}" data-toggle="tooltip" data-placement="top" title="Nuevo Cliente"><i class="fa fa-lg fa-plus"></i></a>
        <a target="_blank" class="btn btn-danger btn-flat" href="{{route('cliente.pdf')}}" data-toggle="tooltip" data-placement="top" title="Imprimir Listado de Clientes"><i class="fa fa-lg fa-file-pdf-o"></i></a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        @include('flash::message')
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-hover table-bordered table-striped" id="sampleTable">
                    <thead>
                        <tr class="info">
                            <th>IDENTIFICACIÓN</th>
                            <th>CLIENTE</th>
                            <th>CORREO</th>
                            <th>TELÉFONO</th>
                            <th>DIRECCIÓN</th>
                            <th>ACCIONES</th>
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
                            <td>
                                <a href="{{route('cliente.edit',$c->id)}}" class="btn btn-primary btn-xs" style="padding: 5px 5px; font-size: 12px; line-height: 0.5; border-radius: 3px;" data-toggle="tooltip" data-placement="top" title="Editar Cliente"><i class="fa fa-edit"></i></a>
                                <a href="{{route('cliente.delete',$c->id)}}" class="btn btn-danger btn-xs" style="padding: 5px 5px; font-size: 12px; line-height: 0.5; border-radius: 3px;" data-toggle="tooltip" data-placement="top" title="Eliminar Cliente"><i class="fa fa-trash"></i></a>
                            </td>
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
    $('#sampleTable').DataTable();
</script>
@endsection