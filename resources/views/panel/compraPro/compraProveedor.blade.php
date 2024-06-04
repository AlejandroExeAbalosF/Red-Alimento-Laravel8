@extends('adminlte::page')

@section('content')

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                aria-selected="false">Realizar Pedido</a>
        </li>
        
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

            <h4>Pedido a Proveedores</h4>
            <div class="row">
                <div class="col-sm-4">
                    <form id="frmVentasProductos">
                        <label>Seleciona Ciclo</label>
                        <select class="form-control input-sm" id="_ciclo" name="proveedorCompra">
                            <option value="A">Selecciona</option>
                            @foreach ($ciclo as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                            @endforeach

                        </select>
                        <label>Seleciona Proveedor</label>
                        <select class="form-control input-sm" id="_proveedor" name="proveedorCompra">
                            <option value="A">Selecciona</option>
                       </select>
                       
                        <!--  <label>Producto</label>
                        <select class="form-control input-sm" id="_productoCompra" name="productoCompra">

                        </select>
                        <span class="btn btn-primary" id="_btnAgregaCompra">Agregar</span> -->


                    </form>
                </div>

                <div class="col-sm-8">

                    <div id="tablaVentasTempLoad">
                        <h4>Realizar Pedido</h4>
                        <h4>
                            <strong>
                                <div id="nombreProveedorCompra"></div>
                            </strong>
                        </h4>


                        <form action="{{ route('generarOrden') }}" method="post">
                            @csrf
                        <table class="table table-bordered table-hover bg-white " style="text-align: center;">
                            

                            <thead class="thead-dark">
                                
                                <tr>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Unidad al x Mayor</th>
                                    <th scope="col">Precio al x Mayor</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col">Eliminar</th>


                                </tr>
                            </thead>
                            
                            
                            <tbody id="_contenido">
                            </tbody>
                            <tr id="_total">
                                <td>Total de pedido: $</td>
                            </tr>
                            <input type="submit" class="btn btn-success" name="save" value="Generar pedido">

                            
                            
                        </table>
                    </form>


                    </div>

                </div>
            </div>

        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
    </div>

@stop

@section('js')

    <script>
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        
        document.getElementById('_ciclo').addEventListener('change', (e) => {
            fetch('getProveedorCiclo', {
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

                var opciones = "<option value=''>Elegir</option>";
                
                for (let i in data.lista) {

                    opciones += '<option value="'+data.lista[i].id+'">' + data.lista[i].nombre +
                        '</option>';
                }

                document.getElementById("_proveedor").innerHTML = opciones;

            }).catch(error => console.error(error));
        })
        






             document.getElementById('_proveedor').addEventListener('change', (e) => {
                  fetch('getProductosProv', {
                      method: 'POST',
                      body: JSON.stringify({
                          id_Prov: e.target.value,
                          id_Ciclo: document.getElementById('_ciclo').value
                      }),
                      headers: {
                          'Content-Type': 'application/json',
                          "X-CSRF-Token": csrfToken
                      }
                  }).then(response => {
                      return response.json()
                  }).then(data => {

                
                      var opciones = "<option value=''>Elegir</option>";
                      
                      for (let i in data.lista) {
                          opciones += '<option value="' + data.lista[i].id + '">' + data.lista[i].nombre +
                              '</option>';
                      }

                      document.getElementById("_productoCompra").innerHTML = opciones;  

                  }).catch(error => console.error(error));
              }) 





              document.getElementById('_proveedor').addEventListener('change', (e) => {
                fetch('getProductosPedido', {
                    method: 'POST',
                    body: JSON.stringify({
                        id_Prov: e.target.value,
                        id_Ciclo: document.getElementById('_ciclo').value
                    }),
                    headers: {
                        'Content-Type': 'application/json',
                        "X-CSRF-Token": csrfToken
                    }
                }).then(response => {
                    return response.json()
                }).then(data => {
                    
                    if (data.success) {
                        
                        /* if (document.getElementById('_productoCompra').value != "nada") {
                            $("#_btnGenerarCompra").show();
                        } else {
                            $("#_btnGenerarCompra").hide();
                        } */
                        cargaTabla(data.lista)
                        
                    } else {
                        cargaTabla()
                    }

                }).catch(error => console.error(error));
            })



            function cargaTabla(datos=[],tipo=true) {
                  

                  if(tipo){
                      contenido.innerHTML = '';
                  }else{

                  }
                  


                  let contF=1;

                  let ciclo=document.getElementById('_ciclo')
                  let selected1 = ciclo.options[ciclo.selectedIndex].text;

                  let proveedor=document.getElementById('_proveedor')
                  let selected2 = proveedor.options[proveedor.selectedIndex].text;
                  
                  for (let valor of datos) {

                    let precio=valor.stock_pedido_mayor * valor.precio_x_cajon
                      
                      contenido.innerHTML += `

                    <input type="hidden" name="ciclo" value="${selected1}">
                    <input type="hidden" name="proveedor" value="${selected2}">

                  <tr class="f${contF}">
                      <td class="c0" hidden>${valor.id}</td>
                      <input type="hidden" name="id[]" value="${valor.id}">

                       <th scope="row" class="c1">${valor.nombre}</th>
                       <input hidden name="nombre[]" value="${valor.nombre}">

                       <td class="c2">${valor.stock_pedido_mayor}</td>
                       <input hidden name="stock_pedido_mayor[]" value="${valor.stock_pedido_mayor}">

                      <td class="c3">${valor.precio_x_cajon}</td>
                      <input hidden name="precio_conjunto_promesa[]" value="${valor.precio_x_cajon}">

                      <td class="c4">${precio}</td>
                      <input hidden name="sub_total[]" value="${precio}">

                      <td class="c5">
                          <button type="button" class="btn btn-danger btn-xs _btmEliminar">X</button>
                      </td>
                  </tr>
                  `
                      
                      contF++
                  }
                 console.log(document.getElementsByClassName("c4"))
                  actualizarTotal();
                 
              }




              var contenido = document.querySelector('#_contenido')
              var contenidoTotal = document.querySelector('#_total')





              $(document).on('click','._btmEliminar', removeElement);

              function removeElement(){
                  $(this).parent().parent().remove();
                  actualizarTotal();
              }

                 

                 


              
              function actualizarTotal(){
                  elementos = document.getElementsByClassName('c4');
                  
                  acu=0;
                  for(let valor of elementos){
                      acu+=Number.parseFloat(valor.textContent);
                     
                  }             
                  contenidoTotal.innerHTML =`
              <td>Total de pedido: $${acu}</td>
              <input hidden name="total" value="${acu}">
          
              `;
              }

            
    </script>

@stop
