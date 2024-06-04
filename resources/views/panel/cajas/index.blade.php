@extends('adminlte::page')
@section('title', 'Caja')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap4.min.css">
@stop

@section('content_header')
    <h1>Apertura de Caja</h1>
@stop
@section('content')

    <!--Muestra el mensaje de guardado-->
    @if(Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('mensaje')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    @endif

    <div class="card-header">
        <a href="{{route('panel.cajas.create')}}" class="btn btn-info">
            <i class="fas fa-plus"></i> Abrir Caja
        </a>
    </div>

    <div class="card-body">
        
        <a href="{{ route('exportar-caja-excel') }}" class="btn btn-success" title="Excel">
            <i class="fas fa-file-excel"></i>
        </a>

        <a href="{{ route('exportar-caja-pdf') }}" class="btn btn-danger" title="PDF" target="_blank">
            <i class="fas fa-file-pdf"></i>
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="tabla-caja">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Monto Inicial</td>
                        <td>Total Ventas</td>
                        <td>Total Compras</td>
                        <td>Monto Final</td>
                        <td>Estado</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cajas as $caja)
                        <tr>
                            <td>{{$caja->id}}</td>
                            <td>{{$caja->monto_inicial}}</td>
                            <td>{{$caja->total_ventas}}</td>
                            <td>{{$caja->total_compras}}</td>
                            <td>{{$caja->monto_final}}</td>

                            <!--Pone en color el estado de la caja y oculta el boton cerrar caja-->
                            @if ($caja->estado == 1)
                                <td>
                                    <span class="badge badge-pill badge-success">ABIERTA <i class="fas fa-check"></i></span>
                                </td>

                                <td>
                                    <a href="{{route('panel.cajas.show',$caja)}}" class="btn btn-success btn-sm">Ver</a>
                                    
                                    <a href="{{route('panel.cajas.edit',$caja)}}" id="cerrarCaja" class="btn btn-danger btn-sm">Cerrar Caja</a>
                                </td>
                            @else
                                <td>
                                    <span class="badge badge-pill badge-danger">Cerrada <i class="fas fa-times"></i></span>
                                </td>
                                <td>
                                    <a href="{{route('panel.cajas.show',$caja)}}" class="btn btn-success btn-sm">Ver</a>
                                </td>
                            @endif

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
    
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap4.min.js"></script>
    <script>
        $('#tabla-caja').DataTable({
            responsive: true,
            autoWidth: false,

            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por pagina",
                "zeroRecords": "Registro no encontrado - Disculpa",
                "info": "Mostrando la pagina _PAGE_ de _PAGES_",
                "infoEmpty": "No records available",
                "infoFiltered": "(filtrado de _MAX_ registro totales)",
                "search": "Buscar",
                "paginate": {
                    'next': 'Siguiente',
                    'previous': 'Anterior'
                }
            }
        });
    </script>
@stop
