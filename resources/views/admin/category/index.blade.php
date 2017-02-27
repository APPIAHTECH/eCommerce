@extends('admin.template')
@section('content')

<div class='container text-center'>
    <div class="container text-center">
		<div class="page-header">
			<h1>
				<i class="fa fa-shopping-cart"></i>
				CATEGORIES <a href="{{route('category.create')}}" class="btn btn-warning"><i class="fa fa-plus-circle"></i> Categoria</a>
			</h1>
		</div>
    </div>
<!--
    <div class="page-header">
        <h1>
            <i class ='fa fa-shopping-cart'></i>CATEGORIES
            <a href="#" class ='btn btn-warning'><i class ='fa fa-plus-circle'></i> Nova Categoria</a>
        </h1>
    </div>
-->
    
    <div class="table-responsive page">
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th>Editar</th>
                    <th>Eliminar</th>
                    <th>Nom</th>
                    <th>Descripció</th>
                    <th>Color</th>
                </tr>
            </thead>
            
            <body>
                            
                @foreach($categories as $category)
                    <tr>
                        <td>
                            <a href="{{ route('category.edit', $category) }}" class="btn btn-primary">
                                <i class="fa fa-pencil-square"></i>
                            </a>
                        </td>
                        <td>
                            {!! Form::open(['route' => ['category.destroy', $category]]) !!}
                                <input type="hidden" name="_method" value="DELETE">
                                <button onClick="return confirm('Eliminar registro?')" class="btn btn-danger">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            {!! Form::close() !!}
                        </td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>{{ $category->color }}</td>
                    </tr>
                @endforeach
                
                
            </body>
        </table>
    </div>
</div>

@stop