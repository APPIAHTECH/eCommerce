@extends ('store.template')
@section ('content')

 <div class = "page-header centrar">
    <h1><i class="fa fa-shopping-cart"></i> Detall del producte</h1>
</div>

<div class="row">
    <div class ="col-md-6">
       <div class="product-block">
            <img src="{{$product->image}}" alt =”150” width="250px" height="250px">
        </div>
    </div>
    <div class ="col-md-6">
        <div class="product-block centrar">
          <h3>{{$product->name}}</h3><hr/>
          <div class="product-info panel">
            <div class="desc">
                <p>{{$product->description}}</p>
            </div>
            <h3><span class="label label-success">Preu: {{number_format($product->price,2)}} € </span></h3>
            <p>
             <a class="btn btn-warning btn-block" href="{{route('cart-add',$product->slug)}}">Comprar
                <i class="fa fa-cart-plus fa-2x"></i>
              </a>
            </p>
          </div>
        </div>


    </div>
</div>

<hr/>
         <p class="centrar">
            <a class="btn btn-primary" href="{{route('home')}}">
                <i class ="fa fa-chevron-circle-right"></i> Tornar
            </a>
         </p>

@stop
