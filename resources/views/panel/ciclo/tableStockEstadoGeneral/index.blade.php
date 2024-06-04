@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    <h1>Ciclo {{$cicloA->estado}}: {{ $cicloA->nombre}}</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-3">

                {{-- <a href="{{ route('producto.create') }}" class="btn btn-success text-uppercase">
                Nuevo Producto
            </a> --}}


            </div>
            @if (session('alert'))
                <div class="col-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('alert') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="tabla-productos" class="table table-striped table-hover w-100">
                            <thead>
                                <tr>
                                    {{-- <th scope="col">#</th> --}}
                                    <th scope="col" class="text-uppercase">Producto</th>
                                    <th scope="col" class="text-uppercase">Proveedor</th>
                                    <th scope="col" class="text-uppercase">Nodo Base</th>
                                    <th scope="col" class="text-uppercase">Nodo Distribuidor</th>
                                    <th scope="col" class="text-uppercase">Estado del Pedido de Compra</th>
                                    <th scope="col" class="text-uppercase">Stock Prometido Por Mayor</th>
                                    <th scope="col" class="text-uppercase">kg por Cajon</th>
                                    <th scope="col" class="text-uppercase">Total de kg</th>
                                    <th scope="col" class="text-uppercase">Total ud. minima Pedido por los Clientes</th>
                                    <th scope="col" class="text-uppercase">Total ud. mayor recibido Nodo Base</th>
                                    <th scope="col" class="text-uppercase">Total ud. minima recibido Nodo Base</th>
                                    <th scope="col" class="text-uppercase">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($SEGs as $SEG)
                                    <tr>
                                        {{-- <td>{{ $SEG->id }}</td> --}}
                                        <td>{{ $SEG->namep }}</td>
                                        <td>{{ $SEG->nameprov }}</td>
                                        <td>{{ $SEG->namenb }}</td>
                                        <td>{{ $SEG->namend }}</td>
                                        <td>{{ $SEG->estado_pedido_compra}}</td>
                                        <td>{{ $SEG->stock.' '. $SEG->unidad_mayor }}</td>
                                        <td>{{ $SEG->kg_x_cajon.' '. $SEG->unidad_menor  }}</td>
                                        <td>{{ $SEG->stock * $SEG->kg_x_cajon.' '. $SEG->unidad_menor  }}</td>
                                        <td>{{ $SEG->stock_pedido_menor.' '. $SEG->unidad_menor }}</td>
                                        <td>{{ $SEG->nb_cantidad_pedido_recibido_mayor.' '. $SEG->unidad_mayor  }}</td>
                                        <td>{{ $SEG->nb_cantidad_pedido_recibido_menor.' '. $SEG->unidad_menor  }}</td>
                                        <td>
                                            <div class="d-flex">
                                                @if ($SEG->estado_pedido_compra =='Realizado')
                                                    <a href="{{ route('proceso.ciclo.edit', $SEG) }}"
                                                        class="btn btn-sm btn-info text-white text-uppercase me-1">
                                                        Editar
                                                    </a>                                                    
                                                @else
                                                    <a href="#"
                                                    class="btn btn-sm btn-info text-white text-uppercase me-1 disabled">
                                                        Editar
                                                    </a>                                                    
                                                @endif
                                                
                                                
                                                {{-- <a href="{{ route('producto.edit', $producto) }}" class="btn btn-sm btn-warning text-white text-uppercase me-1">
                                        Editar
                                    </a>
                                    <form action="{{ route('producto.destroy', $producto) }}" method="POST">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" data-dismiss="" class="btn btn-sm btn-danger text-uppercase">
                                            Eliminar
                                        </button>
                                    </form> --}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row mt-4">
                            @if ($cicloA->estado == 'activo')
                            <form action="{{ route('pendienteCiclo') }}" method="post">
                                @csrf
                                {{-- <button id="button" class="btn btn-sm btn-info text-white text-uppercase me-1">Row count</button> --}}
                                <input type="hidden"  name="idCiclo" value="{{$cicloA->id}}">
                                <button id="button-pc" class="btn btn-sm btn-info text-white text-uppercase me-1">Terminar venta al Publico</button>
                                {{-- <input type="submit" id="button-pc" class="btn btn-sm btn-info text-white text-uppercase me-1" value="Terminar venta al Publico"> --}}
                            </form>
                            @endif
                            
                            <form action="{{ route('cerrarCiclo') }}" method="post">
                                @csrf
                                {{-- <button id="button" class="btn btn-sm btn-info text-white text-uppercase me-1">Row count</button> --}}
                                <input type="hidden" id="cc" name="idCiclo" value="{{$cicloA->id}}">
                                
                                <input type="submit" class="btn btn-sm btn-danger text-white text-uppercase ml-2" id="button" value="Cerrar ciclo">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @stop

    @section('css')

    @stop

    @section('js')
        <script src="{{ asset('user1.js') }}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // $(document).on('click', '#button-pc', confirmacionP);

            // function confirmacionP(){
            //     Swal.fire({
            //         title: 'Desea Terminar la Venta al Publico?',
            //         text: "",
            //         icon: 'warning',
            //         showCancelButton: true,
            //         confirmButtonColor: '#3085d6',
            //         cancelButtonColor: '#d33',
            //         confirmButtonText: 'Si'
            //     }).then((result) => {
            //         if (result.isConfirmed) {
                        
            //             Swal.fire(
            //                 'Esta Hecho.',
            //                 'success'
            //             )
            //             return true
            //         }
            //             return false;
                    
            //     })
            // }

            function confirmacionPendiente(){
                Swal.fire({
                    title: 'Desea Terminar la Venta al Publico?',
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si'
                }).then((result) => {
                    if (result.isConfirmed) {
                        return true
                        Swal.fire(
                            'Esta Hecho.',
                            'success'
                        )
                        
                    }else{
                        return false;
                    }
                })
                return false;
            }
        </script>
    @stop
