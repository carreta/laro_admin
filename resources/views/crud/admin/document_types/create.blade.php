@extends('layouts.app')

@section('content')
<h3>Mantenimiento de tipos de documentos</h3>
<hr>

<div class="container">
	<form class="w-100" action="{{ url('/document_types') }}" method="POST">
		@csrf
		<div class="col-md-6">
			<div class="form-group @if($errors->has('name')) has-error @endif ">
		      <label for="name">Nombre:</label>
			  <input type="text" name="name" class="form-control" placeholder="Nombre" maxlength="200" required>
		      @if($errors->has('name'))<p style="color: red;" class="form-text"> {{ $errors->first('name') }} </p>  @endif
		    </div>
		    <div class="form-group @if($errors->has('hacienda_id')) has-error @endif ">
		      <label for="hacienda_id">Código de hacienda:</label>
			  <input type="text" name="hacienda_id" class="form-control" placeholder="Código de hacienda" maxlength="5" required>
		      @if($errors->has('hacienda_id'))<p style="color: red;" class="form-text"> {{ $errors->first('hacienda_id') }} </p>  @endif
		    </div>
		</div>
		<div class="col-md-12 text-center">
		  <hr>
		  <button id="crear" type="submit" class="btn btn-outline-success">Guardar</button>
		  <a href='{{ url("/document_types") }}' class="btn btn-outline-danger">Cancelar</a>
		</div>
	</form>
</div>

@endsection