@extends('adminlte::page')
@section('title', 'Nodo Distribuidor')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap4.min.css">
@stop

@section('content_header')
    <h1>Listado de Nodo Distribuidor</h1>
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
        <a href="{{route('panel.nodo_distribuidor.create')}}" class="btn btn-info">
            <i class="fas fa-plus"></i> Nuevo Nodo Distribuidor
        </a>

        <a href="{{ route('exportar-nodoDistribuidor-excel') }}" class="btn btn-success" title="Excel">
            <i class="fas fa-file-excel"></i>
        </a>

        <a href="{{ route('exportar-nodoDistribuidor-pdf') }}" class="btn btn-danger" title="PDF" target="_blank">
            <i class="fas fa-file-pdf"></i>
        </a>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="tabla-nodoDistribuidor">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Nombre</td>
                        <td>Email</td>
                        <td>Direccion</td>
                        <td>Nodo Base</td>
                        <td>Celular</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nodoDistribuidor as $nodoD)
                        <tr>
                            <td>{{$nodoD->id}}</td>
                            <td>{{$nodoD->nombre}}</td>
                            <td>{{$nodoD->email}}</td>
                            <td>{{$nodoD->direccion}}</td>
                            <td>{{$nodoD->nodoBase->nombre}}</td>
                            <td>{{$nodoD->celular}}</td>
                            
                            <td>
                                <!--Boton para eliminar con llave de seguridad-->
                                <form action="{{ route('panel.nodo_distribuidor.destroy', $nodoD) }}" method="POST" class="formulario-eliminar">
                                    <a href="{{route('panel.nodo_distribuidor.show',$nodoD)}}" class="btn btn-success">Ver</a>
                                    <a href="{{route('panel.nodo_distribuidor.edit',$nodoD)}}" class="btn btn-info">Editar</a>
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
        $('#tabla-nodoDistribuidor').DataTable({
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
                    'El nodo distribuidor se elimino con exito.',
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
                text: "Este nodo distribuidor se eliminara definitivamente!",
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
