@extends ('store.template')
@section ('content')
<div class="container">
	<br/><br/>
	<h1><i class="fa fa-shopping-cart"></i> Detall del producte</h1>
	<br/><hr/>
    <div class="table-cart">
            <p>
                <a href="{{route('cart-trash')}}" class="btn btn-danger">
                    Buidar Cistella <i class="fa fa-trash"></i>
                </a>
            </p>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Imatge</th>
                        <th>Producte</th>
                        <th>Preu</th>
                        <th>Quantitat</th>
                        <th>Subtotal</th>
                        <th>Treure</th>
                    </tr>
                </thead>
          <tbody>
        @if (count($cart))
            @foreach($cart as $item)
                <tr>
                    <td><img src="{{ $item->image }}"></td>
              <td>{{ $item->name }}</td>
              <td>{{ number_format($item->price,2) }}€</td>
              <td>
				<input type="number" min="1" max="100" value="{{ $item->quantity }}" id ="product_{{$item->id}}">
								<a href="#" class="btn btn-warning btn-update-item" data-href="{{ route('cart-update', $item->slug) }}" data-id = "{{ $item->id }}"><i class="fa fa-refresh"></i></a>
							</td>
              <td>{{ number_format($item->price * $item->quantity,2) }} €</td>
              <td>
                <a href="{{route('cart-delete',$item->slug)}}"class="btn btn-danger">
                <i class="fa fa-remove"></i></a>
							</td>
              </tr>
            </tbody>

              @endforeach
            </table><hr/>
						<h3>
							<span class="label label-success">
								Total : {{number_format($total , 2)}} €
							</span>
						</h3>
						<hr/>

						<a href="{{route('home')}}" class="btn btn-primary"><i class="fa fa-chevron-circle-left"></i> Seguir comprant</a>
						<a href="{{ route('order-detail') }}" class="btn btn-primary"><i class="fa fa-chevron-circle-right"></i> Continuar</a>
						<br/><br/>
        @else
            <h3><span class="label label-danger">La cistella està buida</span></h3>
            <hr>
			<p>
				<a href="{{ route('home') }}" class="btn btn-primary">
					<i class="fa fa-chevron-circle-left"></i> Seguir Comprant
				</a>

				<a href="{{ route('order-detail') }}" class="btn btn-primary">
				 Continuar <i class="fa fa-chevron-circle-right"></i>
				</a>
			</p>
        @endif
    </div>
</div>
@stop
