
@extends ('store.template')
@section ('content')
@include ('store.partials.slider')

<div class="container">
  <div id="products">
      @foreach ($products as $product)
        <div class="product white-panel">
            <h4>{{$product->name}}</h4>
            <img src="{{$product->image}}" ALT =””>

            <div class="product-info">
              <p>{{$product->extract}}</p>
              <h3><span class="label label-success">Preu: {{number_format($product->price,2)}} € </span></h3>

              <p>
                <a class="btn btn-warning" href="{{route('cart-add',$product->slug)}}">
                    <i class="fa fa-cart-plus"></i>Comprar
                </a>
                <a class="btn btn-primary" href="{{route('product-detail', $product->slug)}}">
                    <i class="fa fa-chevron-circle-right"></i>Detall
                </a>
              </p>
            </div>
        </div>
      @endforeach
  </div>
    
    <section class="contingut">
      <div class="pujar"><i class="material-icons">keyboard_arrow_up</i></div>
    </section>
</div>
@stop
