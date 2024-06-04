@extends('adminlte::page')
@section('title', 'Admin')

@section('content_header')
    <h1>Selecionar Productos para El ciclo Iniciado</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table id="tablaselect" class="table table-striped table-hover w-100">
                <thead>
                    <tr>
                        <th scope="col" >#</th>
                        <th scope="col" class="text-uppercase">Producto</th>
                        <th scope="col" class="text-uppercase">Proveedor</th>
                        <th scope="col" class="text-uppercase">Nodo Base</th>
                        <th scope="col" class="text-uppercase">Nodo Distribuidor</th>
                        <th scope="col" class="text-uppercase">Stock Prometido Mayor Total</th>
                        <th scope="col" class="text-uppercase">kg por Cajon</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($tabla as $fila)
                        <tr>
                            <td>{{ $fila->id }}</td>
                            <td>{{ $fila->namep }}</td>
                            <td>{{ $fila->nameprov }}</td>
                            <td>{{ $fila->namenb }}</td>
                            <td>{{ $fila->namend }}</td>
                            <td>{{ $fila->stock }}</td>
                            <td>{{ $fila->kg_x_cajon }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="row mt-4">
                <a href="{{route('proceso.ciclo.index')}}" class="btn btn-sm btn-danger text-white text-uppercase me-1">Cancelar</a>
                <form action="{{ route('crearCiclo') }}" method="post">
                    @csrf
                    {{-- <button id="button" class="btn btn-sm btn-info text-white text-uppercase me-1">Row count</button> --}}
                    <input type="hidden" id="pv" name="productos" value="">
                    <input type="hidden" id="fh" name="fch" value="{{$fechaH}}">
                    <input type="submit" class="btn btn-sm btn-info text-white text-uppercase ml-2" id="button" value="Siguiente">
                </form>
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
            $('#tablaselect').DataTable({
                responsive: true,
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
            document.getElementById("pv").value=valores;

        });

    </script>
@stop
