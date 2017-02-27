@extends('admin.template')
@section('content')
<div class="container text-center">
    <div class="page-header">
        <h1>
            <i class="fa fa-shopping-cart"></i>
            PRODUCTES 
            <a href="{{ route('product.create') }}" class="btn btn-warning">
                <i class="fa fa-plus-circle"></i> Producte
            </a>
        </h1>
    </div>
    <div class="page">

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Editar</th>
                        <th>Eliminar</th>
                        <th>Imatge</th>
                        <th>Nom</th>
                        <th>Categoria</th>
                        <th>Descrpcio</th>
                        <th>Preu</th>
                        <th>Visible</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>
                                <a href="{{ route('product.edit', $product->slug) }}" class="btn btn-primary">
                                    <i class="fa fa-pencil-square-o"></i>
                                </a>
                            </td>
                            <td>
                                {!! Form::open(['route' => ['product.destroy', $product->slug]]) !!}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button onClick="return confirm('Eliminar registre?')" class="btn btn-danger">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                {!! Form::close() !!}
                            </td>
                            <td><img src="{{ $product->image }}" width="40"></td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->extract }}</td>
                            <td>${{ number_format($product->price,2) }}</td>
                            <td>{{ $product->visible == 1 ? "Si" : "No" }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <hr>

        <?php echo $products->render(); ?>

    </div>

</div>
	
@stop