@extends('admin.template')
@section('content')

    <div class="container text-center">
        
        <div class="page-header">
            <h1>
                <i class="fa fa-user"></i> USUARIS <small>[ Editar usuari ]</small>
            </h1>
        </div>
        
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                
                <div class="page">
                    
                    @if (count($errors) > 0)
                        @include('admin.partials.errors')
                    @endif
                    
                    {!! Form::model($user, array('route' => array('user.update', $user))) !!}
                    
                        <input type="hidden" name="_method" value="PUT">
        
                        <div class="form-group">
                            <label for="name">Nom:</label>
                            
                            {!! 
                                Form::text(
                                    'name', 
                                    null, 
                                    array(
                                        'class'=>'form-control',
                                        'placeholder' => 'Introdueix el nom...',
                                        'autofocus' => 'autofocus',
                                        //'required' => 'required'
                                    )
                                ) 
                            !!}
                        </div>
                        
                        <div class="form-group">
                            <label for="last_name">Cognom:</label>
                            
                            {!! 
                                Form::text(
                                    'last_name', 
                                    null, 
                                    array(
                                        'class'=>'form-control',
                                        'placeholder' => 'Introdueix el Cognom...',
                                        //'required' => 'required'
                                    )
                                ) 
                            !!}
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Correu Electronic:</label>
                            
                            {!! 
                                Form::text(
                                    'email', 
                                    null, 
                                    array(
                                        'class'=>'form-control',
                                        'placeholder' => 'Introdueix el correu...',
                                        //'required' => 'required'
                                    )
                                ) 
                            !!}
                        </div>
                        
                        <div class="form-group">
                            <label for="user">Usuari:</label>
                            
                            {!! 
                                Form::text(
                                    'user', 
                                    null, 
                                    array(
                                        'class'=>'form-control',
                                        'placeholder' => 'Introdueix el nom de usuari...',
                                        //'required' => 'required'
                                    )
                                ) 
                            !!}
                        </div>
                        
                        <div class="form-group">
                            <label for="type">Tipo:</label>
                            
                            {!! Form::radio('type', 'user', $user->type=='user' ? true : false) !!} User
                            {!! Form::radio('type', 'admin', $user->type=='admin' ? true : false) !!} Admin
                        </div>
                        
                        <div class="form-group">
                            <label for="address">Direccio:</label>
                            
                            {!! 
                                Form::textarea(
                                    'address', 
                                    null, 
                                    array(
                                        'class'=>'form-control'
                                    )
                                ) 
                            !!}
                        </div>
                        
                        <div class="form-group">
                            <label for="active">Actiu:</label>
                            
                            {!! Form::checkbox('active', null, $user->active == 1 ? true : false) !!}
                        </div><hr>
                        
                        <fieldset>
                            <legend>Cambiar Contrasenya:</legend>
                            <div class="form-group">
                                <label for="password">Contrasenya Nova:</label>
                                
                                {!! 
                                    Form::password(
                                        'password', 
                                        array(
                                            'class'=>'form-control',
                                            //'required' => 'required'
                                        )
                                    ) 
                                !!}
                            </div>
                            
                            <div class="form-group">
                                <label for="confirm_password">Confirmar Contrasenya Nova:</label>
                                
                                {!! 
                                    Form::password(
                                        'password_confirmation',
                                        array(
                                            'class'=>'form-control',
                                            //'required' => 'required'
                                        )
                                    ) 
                                !!}
                            </div>
                        </fieldset><hr>
                        
                        <div class="form-group">
                            {!! Form::submit('Actualizar', array('class'=>'btn btn-primary')) !!}
                            <a href="{{ route('user.index') }}" class="btn btn-warning">Cancel-lar</a>
                        </div>
                    
                    {!! Form::close() !!}
                    
                </div>
                
            </div>
        </div>
        
    </div>

@stop