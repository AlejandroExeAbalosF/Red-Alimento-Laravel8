@extends('menu')
@section('content2')   
<br>

<form class="guardar-pedido" action="{{route('guardarp')}}" method="POST">
    {{ csrf_field() }}
    @csrf
<div class="container" style="margin-top: 80px">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('indexPublic')}}">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Carrito</li>
        </ol>
    </nav>
    @if(session()->has('success_msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('success_msg') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif
    @if(session()->has('alert_msg'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session()->get('alert_msg') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif
    @if(count($errors) > 0)
        @foreach($errors0>all() as $error)
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endforeach
    @endif
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <br>
            @if(\Cart::getTotalQuantity()>0)
                <h4>{{ \Cart::getTotalQuantity()}} productos en el carrito</h4><br>
            @else
                <h4>No tiene productos en el carrito</h4><br>
                <a href="{{route('indexPublic')}}" class="btn btn-warning text-white ">Continuar Comprando</a>
            @endif

            {{-- <input type="hidden" id="kg_x_cajon" name="kg_x_cajon" value="{{ $item->kg_x_cajon }}"> --}}

            @foreach($cartCollection as $item)
                <div class="row">
                    <div class="col-lg-3">
                        <input type="hidden" name="idPPN[]" value="{{ $item->id }}">
                        <input type="hidden" name="preP[]" value="{{ $item->price }}">
                        <input type="hidden" name="subTP[]" value="{{\Cart::get($item->id)->getPriceSum()}}">
                        <input type="hidden"  name="quantP[]" value="{{ $item->quantity }}">
                        <input type="hidden" name="totalP" value="{{ \Cart::getTotal() }}">
                        <input type="submit"  name="kgxcj[]" value="{{ $item->kgxcj }}">
                        
                                    <img src="{{ $item->attributes->imagen }}" class="img-thumbnail" width="300" height="300">
                                </div>
                                <div class="col-lg-5">
                                    <p>
                                        <b><a href="/shop/{{ $item->attributes->slug }}">{{ $item->name }}</a></b><br>
                                        <b>Precio unitario: </b>${{ $item->price }}<br>
                                        <b>Sub Total: </b>${{ \Cart::get($item->id)->getPriceSum() }}<br>
                                        </p>
                                   
                                </div>
                              
                    <div class="col-lg-4">
                        <div class="row">
                        @if($item->quantity >= $item->kgxcj)    
                            <form action="{{ route('cart.update') }}" method="POST" >
                                {{ csrf_field() }}
                                <div class="form-group row">
                                    <input type="hidden" value="{{ $item->id}}" id="id" name="id">
                                    <input type="number" min="1" class="form-control form-control-sm" value="{{ $item->quantity }}"
                                           id="quantity" name="quantity" style="width: 70px; margin-right: 10px;">
                                    <button class="" style="margin-right: 25px;"><i class="fa fa-edit"></i>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                              </svg>
                                    </button>
                                </div>
                            </form> 
                        @else <p>LIMITE ALCANZADO</p> @endif
                            <form class="form-eliminar" action="{{ route('cart.remove') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{ $item->id }}" id="id" name="id">
                                <button type="submit" class="btn btn-dark btn-sm" style="margin-right: 10px;"><i class="fa fa-trash"></i>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                      </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <hr>
              
              
            @endforeach
          
            @if(count($cartCollection)>0)
                <form action="{{ route('cart.clear') }}" method="POST">
                    {{ csrf_field() }}
                    <button class="btn btn-danger btn-md">vaciar Carrito</button><br><br>
                </form>
            @endif
        </div>
        @if(count($cartCollection)>0)
       
            <div class="col-lg-5">
                <div class="card">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Total: </b>${{ \Cart::getTotal() }}</li>
                    </ul>
                </div>
               <br>

              <h5>seleccione lugar para retirar su Pedido</h5>
                        @foreach ($nodosD as $nodo)
                        
                        <input type="radio" name="idnodo" value="{{$nodo->id}}">{{$nodo->nombre}} <br>
                       
                       
                        @endforeach
                   <br>
                    
                    
                <br><a href="{{route('indexPublic')}}" class="btn btn-warning text-white">Volver a Tienda</a>
                  <input type="submit"  class="btn btn-success" value="guardar Pedidos"> <br><br>
            
                 
                </form>  

            </div>
        @endif
       
    </div>
  
   
</div>


<script>
    const mixedChart = new Chart(ctx, {
         data: {
                datasets: [{
                    type: 'bar',
                    label: 'Bar Dataset',
                    data: [10, 20, 30, 40]
                }, {
                    type: 'line',
                    label: 'Line Dataset',
                    data: [50, 50, 50, 50],
                }],
                labels: ['January', 'February', 'March', 'April']
        },
            options: options
        });
</script>

@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.0.1/chart.min.js"></script>
    <script type="text/javascript">
          
    //alet para eliminar un producto--------------------------------
    $('.form-eliminar').submit(function(e){
        e.preventDefault();

        Swal.fire({
            title: 'desea aliminar este producto?',
            text: "Ya no se prodra revertir esta accion!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'si, Eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
               
            )
            }
        })
    });
    //usuario no resgistrado alert
    
    // $('.guardar-pedido').submit(function(e){
    //     e.preventDefault();
   
    //         Swal.fire({
    //     title: 'para realizar un pedido debe estar registrado en la pagina!',
    //     showClass: {
    //         popup: 'animate__animated animate__fadeInDown'
    //     },
    //     hideClass: {
    //         popup: 'animate__animated animate__fadeOutUp'
    //     }
    //     })

    // });

    // graficos
    $(document).on('input', '#quantity', validarCant);


    function validarCant() {

        // let idf=$(this).parent().parent()[0].id;
        let input = $(this).val();
        let kg_x_cajon= $('#kg_x_cajon').val() 
    console.log(kg_x_cajon)
        // console.log(typeof parseFloat(input.value)<=parseFloat(document.getElementById("c3" + idf).textContent));
        // console.log(typeof stock);
        // if (input.value > 0 && input.value != "") {

        //     if (input.id == "quantity") {
        //         console.log(input.value);
        //         if (parseFloat(input.value) <= parseFloat(document.getElementById("stockV").value)) {
        //             $("#_btnAgregaProducto").show();
        //         } else {
        //             $("#_btnAgregaProducto").hide()
        //         }


        //     } else {
        //         if (parseFloat(input.value) <= parseFloat(document.getElementById("c3" + $(this).parent().parent()[0]
        //                 .id).textContent)) {
        //             $("#_btnGenerarVenta").show();
        //         } else {
        //             $("#_btnGenerarVenta").hide();
        //         }

        //     }
        // } else {
        //     if (input.id == "cantidadV") {
        //         $("#_btnAgregaProducto").hide();
        //     } else {
        //         $("#_btnGenerarVenta").hide();
        //     }
        // }
}
    </script>
    
@endsection