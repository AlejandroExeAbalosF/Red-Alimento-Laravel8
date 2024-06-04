@extends('adminlte::page')
@section('title', 'Admin')

@section('content_header')
    <h1>Pedido Compra</h1>
    {{-- <h4>Nodo Base: {{ $tabla[0]->namenb }}</h4> --}}
@stop

@section('content')
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                aria-selected="true">Realizar Pedidos de Compra</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                aria-selected="false">Pedidos de Compra Realizados</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="container-fluid mt-2">
                <div class="card">
                    <div class="card-body">
                        <table id="tablaselect" class="table table-striped table-hover w-100">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="text-uppercase">Producto</th>
                                    <th scope="col" class="text-uppercase">Proveedor</th>
                                    <th scope="col" class="text-uppercase">Nodo Distribuidor</th>
                                    <th scope="col" class="text-uppercase">estado_pedido_compra</th>
                                    <th scope="col" class="text-uppercase">Stock Prometido Mayor Total</th>
                                    <th scope="col" class="text-uppercase">kg por Cajon</th>
                                    <th scope="col" class="text-uppercase">stock_pedido_menor</th>
                                    <th scope="col" class="text-uppercase">Acciones</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($tabla) > 0)
                                    @foreach ($tabla as $fila)
                                        <tr>
                                            <td>{{ $fila->id }}</td>
                                            <td>{{ $fila->namep }}</td>
                                            <td>{{ $fila->nameprov }}</td>
                                            <td>{{ $fila->namend }}</td>
                                            <td>{{ $fila->estado_pedido_compra }}</td>
                                            <td>{{ $fila->stock }}</td>
                                            <td>{{ $fila->kg_x_cajon }}</td>
                                            <td>{{ $fila->stock_pedido_menor }}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                @endif


                            </tbody>
                        </table>
                        <div class="row mt-4">
                            {{-- <a href="{{route('proceso.ciclo.index')}}" class="btn btn-sm btn-danger text-white text-uppercase me-1">Cancelar</a> --}}

                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Siguiente
                            </button>
                            @include('panel/pedidoCompra/modalCrearPedido')

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="container-fluid mt-2">
                <div class="card">
                    <div class="card-body">
                        <table id="tabla2" class="table table-striped table-hover w-100">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="text-uppercase">brenda</th>
                                    <th scope="col" class="text-uppercase">Proveedor</th>
                                    <th scope="col" class="text-uppercase">Nodo Distribuidor</th>
                                    <th scope="col" class="text-uppercase">estado_pedido_compra</th>
                                    <th scope="col" class="text-uppercase">Fecha de Emision de Pedido</th>
                                    <th scope="col" class="text-uppercase">Fecha de llegada de Pedido</th>
                                    <th scope="col" class="text-uppercase">Stock Prometido Mayor Total</th>
                                    <th scope="col" class="text-uppercase">kg por Cajon</th>
                                    <th scope="col" class="text-uppercase">stock_pedido_menor</th>
                                    <th scope="col" class="text-uppercase">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($tablapr) > 0)
                                    @foreach ($tablapr as $fila)
                                        <tr>
                                            <td>{{ $fila->id }}</td>
                                            <td>{{ $fila->namep }}</td>
                                            <td>{{ $fila->nameprov }}</td>
                                            <td>{{ $fila->namend }}</td>
                                            <td>{{ $fila->estado_pedido_compra }}</td>
                                            <td>{{ $fila->realizado_pedido_compra }}</td>
                                            <td>{{ $fila->llegada_pedido_compra }}</td>
                                            <td>{{ $fila->stock }}</td>
                                            <td>{{ $fila->kg_x_cajon }}</td>
                                            <td>{{ $fila->stock_pedido_menor }}</td>
                                            <td><a href="{{ route('EditarPedidoCompra', $fila) }}" type="button"  class="btn btn-primary">
                                                Editar
                                            </a></td>
                                            @include('panel/pedidoCompra/editar2')
                                            
                                            
                                        </tr>
                                    @endforeach
                                @endif


                              
                            </tbody>
                        </table>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
    
@stop

@section('js')
    
    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>

    
    {{-- <script src="{{ asset('selectDatatable.js') }}"></script> --}}
    
    <script>
        $(document).ready(function() {
            $('#tabla2').DataTable({
                responsive: true,
                autoWidth: false,
                language: {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "search": "_INPUT_",
                    "searchPlaceholder": "...",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
                
            });
            $('#tablaselect').DataTable({
                responsive: true,
                autoWidth: false,
                language: {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "search": "_INPUT_",
                    "searchPlaceholder": "...",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
                select: true,
                select: {
                    style: 'multi' //single o multi
                }
            });
        });
        // $('#tablaselect tbody').on('click', 'tr', function() {
        //     $(this).toggleClass('selected');
        //     dato = ", " + $(this).find("td:eq(0)").text();
        //     console.log(dato);
        // });
        // $('#tablaselect tbody').on('click', 'tr', function() {
        //     $(this).toggleClass('selected');
        // });
        $('#button').click(function() {
            // alert($('#tablaselect').DataTable().rows('.selected').data().length + ' row(s) selected');
            // console.log($('#tablaselect').DataTable().rows('.selected').data());
            var data = $('#tablaselect').DataTable().rows('.selected').data();
            // console.log(data);
            var valores = [];
            $(data).each(function(i, v) {
                //v[0] tomo la primer columna
                // console.log(v[0]);
                valores.push(v[0]);

            })
            // console.log(valores);
            document.getElementById("pv").value = valores;

        });
    </script>
@stop
