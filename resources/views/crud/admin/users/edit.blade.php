@extends('layouts.app')

@section('content')
<h3>Mantenimiento de usuario</h3>
<hr>

<div class="container">
	<form method="post" action='{{action("App\Http\Controllers\crud\admin\users\UserController@update", $id)}}' accept-charset="UTF-8" enctype="multipart/form-data" >
	    <input name="_method" type="hidden" value="PUT">
	    {{ csrf_field() }}
	    <div class="row">
	    	<div class="col-md-6">
				<div class="form-group @if($errors->has('name')) has-error @endif ">
			      <label for="name">Nombre:</label>
				  <input type="text" name="name" class="form-control" placeholder="Nombre" value="{{ $user[0]->name }}">
			      @if($errors->has('name'))<p style="color: red;" class="form-text"> {{ $errors->first('name') }} </p>  @endif
			    </div>
			    <div class="form-group @if($errors->has('name')) has-error @endif ">
			      <label for="email">Correo:</label>
				  <input type="text" name="email" class="form-control" placeholder="Correo" value="{{ $user[0]->email }}">
			      @if($errors->has('email'))<p style="color: red;" class="form-text"> {{ $errors->first('email') }} </p>  @endif
			    </div>
			    <div class="form-group @if($errors->has('name')) has-error @endif ">
			      <label for="password">Contraseña:</label>
				  <input type="text" name="password" class="form-control" placeholder="Contraseña" value="{{ $user[0]->password }}">
			      @if($errors->has('password'))<p style="color: red;" class="form-text"> {{ $errors->first('password') }} </p>  @endif
			    </div>
			</div>
	    </div>
	    <div class="col-md-12 text-center">
	      <br>
	      <hr>
	      <br>
	      <button id="crear" type="submit" class="btn btn-outline-success">Guardar</button>
	      <a href='{{ url("/users") }}' class="btn btn-outline-danger">Cancelar</a>
	    </div>
	</form>
</div>

@endsection