@extends('adminlte::page')
@section('title', 'Venta Producto')

@section('content_header')
    <h1>Ventas Producto y Facturas</h1>
@stop
@section('content')

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                aria-selected="true">Realizar Venta</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                aria-selected="false">Facturas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                aria-selected="false">Contact</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="card mt-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">

                            <form id="frmVentasProductos">
                                <div class="form-group">
                                    <label>Seleciona Ciclo</label>
                                    <select class="form-control input-sm" id="_ciclo" name="clienteVenta">
                                        <option value="nada">Selecciona</option>
                                        @foreach ($ciclo as $item)
                                            <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Seleciona Cliente</label>
                                    <select class="form-control input-sm" id="_clienteVenta" name="clienteVenta">
                                        <option value="nada">Selecciona</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Producto</label>
                                    <select class="form-control input-sm" id="_productoVenta" name="productoVenta">
                                        <option value="nada">Selecciona</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Descricion</label>
                                    <input readonly="" type="text" id="descripcionV" name="descripcionV"
                                        class="form-control input-sm">
                                </div>
                                <div class="form-group">
                                    <label>Stock</label>
                                    <input readonly="" type="text" class="form-control input-sm" id="stockV"
                                        name="stockV" value="">
                                </div>
                                <label>Cantidad</label>
                                <input type="number" class="form-control input-sm" id="cantidadV" name="cantidadV"
                                    value="">
                                <label>Precio</label>
                                <input readonly="" type="text" class="form-control input-sm" id="precioV"
                                    name="precioV">
                                <p></p>
                                <span class="btn btn-primary" id="_btnAgregaProducto">Agregar</span>
                                <span class="btn btn-danger" id="btnVaciarVentas">Vaciar ventas</span>
                            </form>

                        </div>

                        <div class="col-sm-9">

                            <div id="tablaVentasTempLoad">

                                <h4>
                                    <strong>
                                        <div id="nombreclienteVenta"></div>
                                    </strong>
                                </h4>
                                <form action="{{ route('generarVenta.store') }}" method="post">
                                    @csrf


                                    <table class="table table-bordered table-hover bg-white " style="text-align: center;">
                                        {{-- <caption>
                                        <span class="btn btn-success" onclick="crearVenta()"> Generar venta
                                            <span class="glyphicon glyphicon-usd"></span>
                                        </span>
                                    </caption> --}}

                                        <thead class="thead-dark align-middle">
                                            {{-- <thead class="bg-success"> --}}
                                            <tr class="">
                                                <th scope="col" class="align-middle">Nombre</th>
                                                <th scope="col" style="width: 10%" class="align-middle">Cantidad</th>
                                                <th scope="col" style="width: 15%" class="align-middle">Stock Publico
                                                    Disponible
                                                </th>
                                                <th scope="col" class="align-middle">Precio</th>
                                                <th scope="col" class="align-middle">SubTotal</th>
                                                <th scope="col" class="align-middle">Quitar</th>
                                            </tr>
                                        </thead>
                                        {{--  --}}

                                        <tbody id="_contenido">
                                        </tbody>
                                        <tr id="_total">
                                            <td>Total de venta: </td>
                                        </tr>

                                    </table>
                                    <input type="submit" class="btn btn-success" id="_btnGenerarVenta"
                                        value="Generar venta">
                                </form>
                                {{--  --}}

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @if (Session::has('mensaje'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('mensaje') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
            @endif
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="container-fluid mt-2">
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
                                            <th scope="col">Nro. Factura</th>
                                            <th scope="col" class="text-uppercase">Nombre</th>
                                            <th scope="col" class="text-uppercase">Fecha y Hora</th>
                                            <th scope="col" class="text-uppercase">Total de Venta</th>
                                            {{-- <th scope="col" class="text-uppercase">DNI</th> --}}
                                            <th scope="col" class="text-uppercase">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($ventas as $venta)
                                            <tr>
                                                <td>{{ $venta->id }}</td>
                                                <td>{{ $venta->nombre }}</td>
                                                <td>{{ $venta->fecha_hora }}</td>
                                                <td>{{ $venta->total_venta }}</td>
                                                {{-- <td>{{ $venta->dni }}</td> --}}

                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('hventa.show', $venta) }}"
                                                            class="btn btn-danger" title="PDF">
                                                            <i class="fas fa-file-pdf"></i>
                                                        </a>

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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
        </div>

    @stop

    @section('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('user1.js') }}"></script>
        <script>
            const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
            //select de clienteXciclo
            document.getElementById('_ciclo').addEventListener('change', (e) => {
                fetch('getPedidosCiclo', {
                    method: 'POST',
                    body: JSON.stringify({
                        texto: e.target.value
                    }),
                    headers: {
                        'Content-Type': 'application/json',
                        "X-CSRF-Token": csrfToken
                    }
                }).then(response => {
                    return response.json()
                }).then(data => {
                    let opciones = "<option value='nada'>Seleccionar</option>";
                    opciones += '<option value="nada" id="_clienteP">Cliente Publico</option>';
                    for (let i in data.lista) {
                        opciones += '<option value="' + data.lista[i].id + '">' + data.lista[i].name +
                            '</option>';
                    }
                    // console.log(opciones);
                    document.getElementById("_clienteVenta").innerHTML = opciones;
                    cargaTabla()
                }).catch(error => console.error(error));
            })
            //select ProductoXcliente
            document.getElementById('_clienteVenta').addEventListener('change', (e) => {
                fetch('getProductosPedido', {
                    method: 'POST',
                    body: JSON.stringify({
                        texto: e.target.value
                    }),
                    headers: {
                        'Content-Type': 'application/json',
                        "X-CSRF-Token": csrfToken
                    }
                }).then(response => {
                    return response.json()
                }).then(data => {
                    if (data.success) {
                        // console.log(document.getElementById('_clienteVenta').value);
                        if (document.getElementById('_clienteVenta').value != "nada") {
                            $("#_btnGenerarVenta").show();
                        } else {
                            $("#_btnGenerarVenta").hide();
                        }
                        cargaTabla(data.lista)
                    } else {
                        cargaTabla()
                    }

                }).catch(error => console.error(error));
            })
            //select de productoXciclo y producto>sotckPublico
            document.getElementById('_ciclo').addEventListener('change', (e) => {
                // console.log(e.target.value);
                fetch('getProductosCiclo', {
                    method: 'POST',
                    body: JSON.stringify({
                        texto: e.target.value
                    }),
                    headers: {
                        'Content-Type': 'application/json',
                        "X-CSRF-Token": csrfToken
                    }
                }).then(response => {
                    return response.json()
                }).then(data => {
                    let opciones = "<option value=''>Seleccionar</option>";

                    for (let i in data.lista) {
                        opciones += '<option value="' + data.lista[i].id + '">' + data.lista[i].nombre +
                            '</option>';
                    }

                    document.getElementById("_productoVenta").innerHTML = opciones;

                }).catch(error => console.error(error));
            })
            //carga del informacion del producto
            document.getElementById('_productoVenta').addEventListener('change', (e) => {
                fetch('getProductosInfo', {
                    method: 'POST',
                    body: JSON.stringify({
                        texto: e.target.value
                    }),
                    headers: {
                        'Content-Type': 'application/json',
                        "X-CSRF-Token": csrfToken
                    }
                }).then(response => {
                    return response.json()
                }).then(data => {
                    if (data.success) {

                        document.getElementById("stockV").value = data.lista[0].nd_stock_publico_menor;
                        document.getElementById("precioV").value = data.lista[0].redondeo;

                        $("#cantidadV").prop("disabled", false);

                        // console.log(typeof document.getElementById("cantidadV").value);

                        if (document.getElementById("cantidadV").value > 0 && document.getElementById(
                                "cantidadV").value != "") {
                            $("#_btnAgregaProducto").show();
                        } else {
                            $("#_btnAgregaProducto").hide()
                        }
                        // console.log(data.lista[0].nd_stock_publico_menor);
                    } else {

                        $("#cantidadV").prop("disabled", true);
                        document.getElementById("stockV").value = '';
                        document.getElementById("precioV").value = '';
                        document.getElementById("cantidadV").value = '';
                        $("#_btnAgregaProducto").hide()
                    }


                }).catch(error => console.error(error));
            })


            //agregar una fila a la tabla
            document.getElementById('_btnAgregaProducto').addEventListener('click', function() {
                let combo = document.getElementById("_productoVenta");
                let selected = combo.options[combo.selectedIndex].text;
                let idProducto = document.getElementById("_productoVenta").value;
                // console.log(document.getElementById("_productoVenta").value);
                let cantida = document.getElementById("cantidadV").value;

                let precioV = document.getElementById("precioV").value;

                let sub_total = Number(cantida) * Number(precioV);
                // let content = document.getElementsByTagName("tr");

                let content = document.getElementsByClassName("f");
                let fid = "f" + idProducto;
                // console.log(content);
                // console.log(content[0].id);
                // console.log(typeof idProducto);
                // console.log(document.getElementById("cc"+idProducto).textContent);
                let ban = true;
                for (let element of content) {
                    // console.log(content);
                    if (element.id == fid) {
                        num = document.getElementById("c2f" + idProducto).value;
                        nCant = parseFloat(num) + parseFloat(cantida);
                        // console.log(nCant);
                        // console.log(typeof document.getElementById("c3f" + idProducto).textContent);

                        if (nCant <= parseFloat(document.getElementById("c3f" + idProducto).textContent)) {
                            document.getElementById("c2f" + idProducto).value = nCant;
                            let n = parseFloat(nCant) * parseFloat(precioV);
                            // console.log(nCant);
                            // console.log(precioV);
                            // console.log(n.toFixed(2));

                            document.getElementById("c5" + fid).textContent = n.toFixed(2);
                            document.getElementById("c5i" + fid).value = n.toFixed(2);
                            actualizarTotal();
                        }

                        ban = false;
                        // console.log(document.getElementById("c3f" + idProducto).textContent);


                        break;

                    }

                }

                if (ban) {
                    // console.log(valor.parentNode); 
                    let dato = [{
                        "id": idProducto,
                        "nombre": selected,
                        "cantidad_producto": cantida,
                        "nd_stock_publico_menor": document.getElementById("stockV").value,
                        "precio_unitario": precioV,
                        "sub_total": sub_total
                    }]
                    // console.log(dato);
                    $("#_btnGenerarVenta").show();
                    cargaTabla(dato, false);
                }

            })

            var contenido = document.querySelector('#_contenido')
            var contenidoTotal = document.querySelector('#_total')

            function cargaTabla(datos = [], tipo = true) {
                // console.log(datos);
                if (tipo) {
                    contenido.innerHTML = '';
                } else {

                }
                // acu=0;
                let idC = document.getElementById('_clienteVenta').value;
                // console.log(idC);
                contF = 1;
                for (let valor of datos) {
                    // console.log(valor.nombre);
                    contenido.innerHTML += `
                <input type="hidden"  name="idC" value="${idC}">
                <tr id="f${valor.id}" class="f">
                    <td class="c0" hidden>${valor.id}</td>
                    <input type="hidden"  name="idP[]" value="${valor.id}">
                    <th scope="row" class="c1">${valor.nombre}</th>
                    <input type="hidden" name="nombre[]" value="${valor.nombre}">
                    <td class=""  >
                        
                        <input type="number" name="cantidad_producto[]" class="form-control form-control-sm c2" id="c2f${valor.id}" value="${valor.cantidad_producto}">
                        
                    </td>
                            
                    <td class="c3" id="c3f${valor.id}">${valor.nd_stock_publico_menor}</td>
                    <td class="c4" id="c4f${valor.id}">${valor.precio_unitario}</td>
                    <input type="hidden" name="precio_unitario[]" value="${valor.precio_unitario}">
                    <td class="c5" id="c5f${valor.id}">${valor.sub_total}</td>
                    <input type="hidden" name="sub_total[]" id="c5if${valor.id}" value="${valor.sub_total}">
                    <td class="c6">
                        <button type="button" class="btn btn-danger btn-xs _btmEliminar">X</button>
                    </td>
                </tr>
                `
                    contF++
                }
                actualizarTotal();

            }

            window.addEventListener('load', function() {
                // console.log(document.getElementById("_productoVenta").value);
                if (document.getElementById("_productoVenta").value != "nada") {
                    $("#_btnAgregaProducto").show();
                } else {

                    $("#_btnAgregaProducto").hide();
                }
                $("#_btnGenerarVenta").hide();
                $("#cantidadV").prop("disabled", true);
            });

            $(document).on('input', '#cantidadV', validarCant);
            $(document).on('input', '.c2', validarCant);


            function validarCant() {

                // let idf=$(this).parent().parent()[0].id;
                let input = $(this)[0];


                // console.log(typeof parseFloat(input.value)<=parseFloat(document.getElementById("c3" + idf).textContent));
                // console.log(typeof stock);
                if (input.value > 0 && input.value != "") {

                    if (input.id == "cantidadV") {
                        // console.log(input.value);
                        if (parseFloat(input.value) <= parseFloat(document.getElementById("stockV").value)) {
                            $("#_btnAgregaProducto").show();
                        } else {
                            $("#_btnAgregaProducto").hide()
                        }


                    } else {
                        if (parseFloat(input.value) <= parseFloat(document.getElementById("c3" + $(this).parent().parent()[0]
                                .id).textContent)) {
                            $("#_btnGenerarVenta").show();
                        } else {
                            $("#_btnGenerarVenta").hide();
                        }

                    }
                } else {
                    if (input.id == "cantidadV") {
                        $("#_btnAgregaProducto").hide();
                    } else {
                        $("#_btnGenerarVenta").hide();
                    }
                }
            }

            $(document).on('input', '.c2', actualizarSubTotal);

            $(document).on('click', '._btmEliminar', removeElement);

            function removeElement() {
                Swal.fire({
                    title: 'Eliminar Elemento?',
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).parent().parent().remove();
                        actualizarTotal();
                        Swal.fire(
                            'Poff',
                            'El elemento fue eliminado.',
                            'success'
                        )
                    }
                })


            }

            // var cosa=document.querySelector('#cc7');
            // console.log(cosa);
            // document.querySelector('#cc7').addEventListener('input',function(){
            //     console.log("tamos");
            // });

            function actualizarSubTotal() {
                let element = $(this).parent().parent();
                let cant = $(this);
                let nump = document.getElementById("c4" + element[0].id).textContent;
                // console.log(Number.isNaN(parseFloat(cant[0].value)));
                if (Number.isNaN(parseFloat(cant[0].value))) {
                    nn = 0;
                } else {
                    nn = parseFloat(cant[0].value);
                }
                let n = nn * parseFloat(nump);
                // console.log(nn);
                document.getElementById("c5" + element[0].id).textContent = n.toFixed(2);
                document.getElementById("c5i" + element[0].id).value = n.toFixed(2);
                actualizarTotal();
            }

            function actualizarTotal() {
                elementos = document.getElementsByClassName('c5');
                // console.log(elementos.length);
                if (elementos.length == 0) {
                    $("#_btnGenerarVenta").hide();
                }
                acu = 0;
                for (let valor of elementos) {
                    acu += Number.parseFloat(valor.textContent);
                    // console.log(valor.parentNode); 
                }

                acu = acu.toFixed(2);
                contenidoTotal.innerHTML = `
            <td>Total de venta: ${acu}</td>
            <input hidden name="total" value="${acu}">
        
            `;
            }
        </script>

    @stop
