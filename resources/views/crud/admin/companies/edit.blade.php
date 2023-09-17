@extends('layouts.app')

@section('content')
<h3>{{$view_fields->view_name}}</h3>
<hr>

<div class="container">
	<form method="post" action='{{action("App\Http\Controllers\crud\admin\DocumentTypeController@update", $id)}}' accept-charset="UTF-8" enctype="multipart/form-data" >
	    <input name="_method" type="hidden" value="PUT">
	    {{ csrf_field() }}
	    <div class="col-md-6">
			<div class="form-group @if($errors->has('name')) has-error @endif ">
		      <label for="name">Nombre:</label>
			  <input type="text" name="name" class="form-control" placeholder="Nombre" maxlength="200" required value="{{ $companies[0]->name }}">
		      @if($errors->has('name'))<p style="color: red;" class="form-text"> {{ $errors->first('name') }} </p>  @endif
		    </div>
		    
	    </div>
	    <div class="col-md-12 text-center">
	      <hr>
	      <button id="crear" type="submit" class="btn btn-outline-success">Guardar</button>
	      <a href='{{ $search_parameters }}' class="btn btn-outline-danger">Cancelar</a>
	    </div>
	</form>
</div>

@endsection