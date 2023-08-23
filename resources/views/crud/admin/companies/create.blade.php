@extends('layouts.app')

@section('content')
<h3>Mantenimiento de compañía</h3>
<hr>

<div class="container">
	<form class="w-100" action="{{ url('/companies') }}" method="POST">
		<!-- <input name="_method" type="hidden" value="PUT"> -->
		@csrf
		<div class="col-md-6">
			<div class="form-group @if($errors->has('name')) has-error @endif ">
		      <label for="name">Nombre:</label>
			  <input type="text" name="name" class="form-control" placeholder="Nombre">
		      @if($errors->has('name'))<p style="color: red;" class="form-text"> {{ $errors->first('name') }} </p>  @endif
		    </div>
		    <div class="form-group @if($errors->has('email')) has-error @endif ">
		      <label for="address">Dirección:</label>
			  <input type="text" name="address" class="form-control" placeholder="Dirección">
		      @if($errors->has('address'))<p style="color: red;" class="form-text"> {{ $errors->first('address') }} </p>  @endif
		    </div>
		    <!-- <div class="form-group @if($errors->has('name')) has-error @endif ">
		      <label for="password">Contraseña:</label>
			  <input type="text" name="password" class="form-control" placeholder="Contraseña">
		      @if($errors->has('password'))<p style="color: red;" class="form-text"> {{ $errors->first('password') }} </p>  @endif
		    </div> -->
		</div>
		<div class="col-md-12 text-center">
		  <br>
		  <hr>
		  <br>
		  <button id="crear" type="submit" class="btn btn-outline-success">Guardar</button>
		  <a href='{{ url("/companies") }}' class="btn btn-outline-danger">Cancelar</a>
		</div>
	</form>
</div>

@endsection