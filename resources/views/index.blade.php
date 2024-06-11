@extends('menu')

@section('content1')
<header class="content header">

  <strong>  <p>Red de Alimentos</p>
    <h1>SUMAK KAWSAY</h1>
    <P>Alimentos organicos.</P></strong>
</header>

<div class="container py-0" style="margin-top: 80px">

<nav class="navbar navbar-light bg-light">
    <div>
            <select class="select" id="_categoria">
                @foreach ($categoria as $car)
                    <option value="{{$car->id}}"> 
                    {{$car->nombre}} 
                    </option>    
                @endforeach
            
            </select> 
    </div> 
    <form class="form-inline my-2 my-lg-0 float-right">
        <input name="buscarpor" class="form-control mr-sm-2" type="search" placeholder="buscar un producto" aria-label="Search" value="{{$buscarpor}}">
        <button class="btn btn-success my-2 my-sm-0" type="submit" style="border-radius: 50%">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
              </svg>
        </button>
    </form>

  </nav>
   
{{-- ------------------------ --}}
{{-- <div style="text-align: center">
        <h6>Loading......</h6>
            <div class="spinner-grow text-success" role="status">
            <span class="sr-only"> Loading...</span>
        </div>
        <div class="spinner-grow text-success" role="status" >
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-success" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-success" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-success" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-success" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-success" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-success" role="status">
            <span class="sr-only">Loading...</span>
        </div>
</div> --}}
{{-- --------- --}}
  <div class="row justify-content-center">
      <div class="col-lg-12">
          <div class="row">
              <div class="col-lg-7">
                  <h4>Productos disponibles</h4>
              </div>
          </div>
          <hr>
          <div class="row" id="produCategoria">
         @if (count($productos)<=0) 
         <div class="alert alert-success" role="alert">
            <h6>no se encontraron resultados para su busqueda! </h6>   
          </div>
            @else
            <?php for($i=0; $i < count($productos); $i++ ){ ?>
                <?php for($j=0; $j < count($productos[$i]); $j++ ){ ?>
                    <div class="col-lg-3">
                        <div class="card border-success mb-3" style="margin-bottom: 20px; height: auto;">
                          <img  src="{{ asset($productos[$i][$j]->imagen) }}" alt="{{ $productos[$i][$j]->nombre }}" id="image_preview" class="imagen">
                            <div class="card-body">
                                <h6 class="card-title">{{ $productos[$i][$j]->nombre }}</h6>
                                <h6 class="card-title">disponible {{( $productos[$i][$j]->kg_x_cajon ) * ($productos[$i][$j]->stock)}}kg</h6> 
                                {{-- <p>{{ $pro->descripcion}}</p> --}}
                                 <p>$ {{ $productos[$i][$j]->precio_final}}</p>
                                <form action="{{ route('cart.store') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $productos[$i][$j]->id }}" id="id" name="id">
                                    <input type="hidden" value="{{ $productos[$i][$j]->nombre }}" id="name" name="name">
                                    <input type="hidden" value="{{ $productos[$i][$j]->precio_final}}" id="price" name="price">
                                    <input type="hidden" value="{{ $productos[$i][$j]->imagen }}" id="imagen" name="imagen">
                                    <input type="hidden" value="1" id="quantity" name="quantity">
                                    <input type="hidden" value="{{ $productos[$i][$j]->kg_x_cajon }}" id="kgxcj" name="kgxcj"> 
                                    @if($productos[$i][$j]->kg_x_cajon > 0)
                                    <div class="card-footer" style="background-color: white;">
                                          <div class="row">
                                            <button   class="botones" title="add to cart">
                                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket2" viewBox="0 0 16 16">
                                                  <path d="M4 10a1 1 0 0 1 2 0v2a1 1 0 0 1-2 0v-2zm3 0a1 1 0 0 1 2 0v2a1 1 0 0 1-2 0v-2zm3 0a1 1 0 1 1 2 0v2a1 1 0 0 1-2 0v-2z"/>
                                                  <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-.623l-1.844 6.456a.75.75 0 0 1-.722.544H3.69a.75.75 0 0 1-.722-.544L1.123 8H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.163 8l1.714 6h8.246l1.714-6H2.163z"/>
                                                </svg>
                                                <i class="fa fa-shopping-cart"></i> agregar al carrito
                                            </button>
                                        </div> 
                                    </div> @else <p>PRODUCTO SIN STOCK</p> @endif 
                                </form>
                            </div>
                        </div>
                    </div> 
                <?php } ?>   
            <?php } ?>
               {{-- @foreach($productos[$i] as $pro) 
             
                   <div class="col-lg-3">
                      <div class="card border-success mb-3" style="margin-bottom: 20px; height: auto;">
                        <img  src="{{ $pro->imagen }}" alt="{{ $pro->nombre }}" id="image_preview" class="imagen">
                          <div class="card-body">
                              <h6 class="card-title">{{ $pro->nombre }}</h6>
                              <h6 class="card-title">disponible {{ $pro->kg_x_cajon *  $pro->stock }}kg</h6> 
                              {{-- <p>{{ $pro->descripcion}}</p> 
                               <p>$ {{ $pro->precio_final}}</p>
                              <form action="{{ route('cart.store') }}" method="POST">
                                  {{ csrf_field() }}
                                  <input type="hidden" value="{{ $pro->id }}" id="id" name="id">
                                  <input type="hidden" value="{{ $pro->nombre }}" id="name" name="name">
                                  <input type="hidden" value="{{ $pro->precio_final}}" id="price" name="price">
                                  <input type="hidden" value="{{ $pro->imagen }}" id="imagen" name="imagen">
                                  <input type="hidden" value="1" id="quantity" name="quantity">

                                  <div class="card-footer" style="background-color: white;">
                                        <div class="row">
                                          <button   class="botones" title="add to cart">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket2" viewBox="0 0 16 16">
                                                <path d="M4 10a1 1 0 0 1 2 0v2a1 1 0 0 1-2 0v-2zm3 0a1 1 0 0 1 2 0v2a1 1 0 0 1-2 0v-2zm3 0a1 1 0 1 1 2 0v2a1 1 0 0 1-2 0v-2z"/>
                                                <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-.623l-1.844 6.456a.75.75 0 0 1-.722.544H3.69a.75.75 0 0 1-.722-.544L1.123 8H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.163 8l1.714 6h8.246l1.714-6H2.163z"/>
                                              </svg>
                                              <i class="fa fa-shopping-cart"></i> agregar al carrito
                                          </button>
                                      </div> 
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div> 
                  @endforeach --}}
                  
            @endif
          </div>
      </div>
  </div>
  
</div>
<br><br>
      {{-- <div style="text-align: center">
          {{$productos->links()}}
      </div> --}}
<br><br>

@include('footer.footer')

<script>
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
            document.getElementById('_categoria').addEventListener('change',(e)=>{
          fetch('productoCategoria',{
              method : 'POST',
              body: JSON.stringify({texto : e.target.value}),
              headers:{
                  'Content-Type': 'application/json',
                  "X-CSRF-Token": csrfToken
              }
          }).then(response =>{
              return response.json()
          }).then( data =>{
        
            opciones.innerHTML="";
            
            if(data.success){

                mostrarCartas(data.lista)

            }else{
                
                mostrarCartas()

            }

            }).catch(error =>console.error(error));
         });

         var opciones= document.querySelector('#produCategoria');

         

         function mostrarCartas(datos=[]) 
         {

            for (let i in datos) {
                opciones.innerHTML += ` 
                <div class="col-lg-3">
                      <div class="card" style="margin-bottom: 20px; height: auto;">
                        <img  src="${datos[i].imagen}" alt="${datos[i].nombre}" id="image_preview" class="imagen">
                          <div class="card-body">
                              <h6 class="card-title">${datos[i].nombre}</h6>
                             
                               <p>$ ${datos[i].redondeo}</p>
                              <form action="{{ route('cart.store') }}" method="POST">
                                  {{ csrf_field() }}
                                  <input type="hidden" value="${datos[i].id}" id="id" name="id">
                                  <input type="hidden" value="${datos[i].nombre}" id="name" name="name">
                                  <input type="hidden" value="${datos[i].redondeo}" id="price" name="price">
                                  <input type="hidden" value="${datos[i].imagen}" id="imagen" name="imagen">
                                  <input type="hidden" value="1" id="quantity" name="quantity">
                                  <div class="card-footer" style="background-color: white;">
                                        <div class="row">
                                          <button   class="botones" title="add to cart">
                                              <i class="fa fa-shopping-cart"></i> agregar al carrito
                                          </button>
                                      </div> 
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
                ` 
console.log(opciones);

              }     
         }


     
</script>
@endsection
@section('js')
<script>
    $('.guardar-pedido').submit(
   preventDefault();

Swal.fire({
    position: 'top-end',
    icon: 'success',
    title: 'pedido guardado con exito!',
    showConfirmButton: false,
    timer: 1500
    })
);
</script>
@endsection

