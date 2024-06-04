@extends('adminlte::page')
@section('title', 'Proveedores')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap4.min.css">
@stop

@section('content_header')
    <h1>Listado de Proveedores</h1>
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
        <a href="{{route('panel.proveedores.create')}}" class="btn btn-info">
            <i class="fas fa-plus"></i> Nueva Proveedor    
        </a>

        <a href="{{ route('exportar-proveedore-excel') }}" class="btn btn-success" title="Excel">
            <i class="fas fa-file-excel"></i>
        </a>

        <a href="{{ route('exportar-proveedore-pdf') }}" class="btn btn-danger" title="PDF" target="_blank">
            <i class="fas fa-file-pdf"></i>
        </a>
    </div>
    
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="tabla-proveedors">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Nombre</td>
                        <td>Apellido</td>
                        <td>Razon social</td>
                        <td>Direccion</td>
                        <td>Provincia</td>
                        <td>Region</td>
                        <td>Email</td>
                        <td>Celular</td>
                        <td>Telefono</td>
                        <td>Cuil</td>
                        <td>Acciones</td>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($proveedor as $prove)
                        <tr>
                            <td>{{$prove->id}}</td>
                            <td>{{$prove->nombre}}</td>
                            <td>{{$prove->apellido}}</td>
                            <td>{{$prove->razon_social}}</td>
                            <td>{{$prove->direccion}}</td>
                            <td>{{$prove->provincia}}</td>
                            <td>{{$prove->region}}</td>
                            <td>{{$prove->email}}</td>
                            <td>{{$prove->celular}}</td>
                            <td>{{$prove->telefono}}</td>
                            <td>{{$prove->cuil}}</td>
                            
                            <td>
                                <!--Boton para eliminar con llave de seguridad-->
                                <form action="{{ route('panel.proveedores.destroy', $prove) }}" method="POST" class="formulario-eliminar">
                                    <a href="{{route('panel.proveedores.edit',$prove)}}" class="btn btn-info">Editar</a>
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
        $('#tabla-proveedors').DataTable({
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
                    'El proveedor se elimino con exito.',
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
                text: "Este proveedor se eliminara definitivamente!",
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
