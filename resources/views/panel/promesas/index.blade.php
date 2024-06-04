@extends('adminlte::page')
@section('title', 'Promesa')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap4.min.css">
@stop

@section('content_header')
    <h1>Listado de las Promesa y Armado de precio</h1>
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
        <a href="{{route('panel.promesas.create')}}" class="btn btn-info">
            <i class="fas fa-plus"></i> Precio x Cajon    
        </a>

        <a href="{{route('panel.promesas.prome2.create')}}" class="btn btn-secondary">
            <i class="fas fa-plus"></i> Precio x Kg
        </a>

        <a href="{{ route('exportar-prov_prod_nodo-excel') }}" class="btn btn-success" title="Excel">
            <i class="fas fa-file-excel"></i>
        </a>

        <a href="{{ route('exportar-prov_prod_nodo-pdf') }}" class="btn btn-danger" title="PDF" target="_blank">
            <i class="fas fa-file-pdf"></i>
        </a>
    </div>
    
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="tabla-promesa">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Producto</td>
                        <td>Fecha Limite</td>
                        <td>Precio x Kg</td>
                        <td>Precio Final p/venta</td>
                        <td>Precio x Cajon</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($promesa as $prome)
                        <tr>
                            <td>{{$prome->id}}</td>
                            <td>{{$prome->producto->nombre}}</td>
                            <td>{{$prome->fecha_limite_promesa}}</td>
                            <td>{{$prome->precio_x_kg}}</td>
                            <td>{{$prome->precio_final}}</td>
                            <td>{{$prome->precio_final2}}</td>
                            
                            <td>
                                <!--Boton para eliminar con llave de seguridad-->
                                <form action="{{ route('panel.promesas.destroy', $prome) }}" method="POST" class="formulario-eliminar">
                                    <a href="{{route('panel.promesas.show',$prome)}}" class="btn btn-success">Ver</a>
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
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

    <!--Mensaje de eliminar-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $('#tabla-promesa').DataTable({
            responsive: true,
            autoWidth: false,

            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por pagina",
                "zeroRecords": "Registro no encontrado - Disculpa",
                "info": "Mostrando la pagina _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registro disponibles.",
                "infoFiltered": "(filtrado de _MAX_ registro totales)",
                "search": "Buscar",
                "paginate": {
                    'next': 'Siguiente',
                    'previous': 'Anterior'
                }
            }
        });
    </script>

    <!--Mensaje de eliminar-->
    @if(session('eliminar') == 'Ok')
        <script>
            Swal.fire(
                    '!Eliminado!',
                    'El armado de precio se elimino con exito.',
                    'success'
                )
        </script>
    @endif

    <script>
        $('.formulario-eliminar').submit(function(e)
        {
            e.preventDefault();
            Swal.fire({
                title: '¿Estas seguro?',
                text: "Este armado de precio se eliminara definitivamente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '!Si, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed)
                {
                    this.submit();
                }
            })
        });
    </script>
    <!--Fin del mensaje-->
@stop
