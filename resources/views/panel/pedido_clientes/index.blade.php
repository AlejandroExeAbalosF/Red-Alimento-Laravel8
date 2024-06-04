@extends('adminlte::page')
@section('title', 'Pedido Clientes')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap4.min.css">
@stop

@section('content_header')
    <h1>Listado de Pedidos Realizados</h1>
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
        <a href="" class="btn btn-info">
            <i class="fas fa-plus"></i> Nuegoria
        </a>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="tabla-Pedido_Clientes">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Total</td>
                        <td>Total_de_pago</td>
                        <td>Cliente</td>
                        <td>Nodo Distribuidor</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedido_clientes as $pedc)
                        <tr>
                            <td>{{$pedc->id}}</td>
                            <td>{{$pedc->Total}}</td>
                            <td>{{$pedc->Total_de_pago}}</td>
                            <td>{{$pedc->usuarios->nombre}}</td>
                            <td>{{$pedc->nodoDistribuidor->nombre}}</td>

                            
                            <td>
                                <!--Boton para eliminar con llave de seguridad-->
                                <form action="" method="POST" class="formulario-eliminar">
                                    <a href="" class="btn btn-success">Ver</a>
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
        $('#tabla-Pedido_Clientes').DataTable({
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
                    'La categoria se elimino con exito.',
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
                text: "Esta categoria se eliminara definitivamente!",
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
