@extends('layouts.app')

@section('content')
<h3>{{$view_fields->view_name}}</h3>
<hr>

<div class="container">
	<form class="w-100" action="{{ url('/companies') }}" method="POST">
		@csrf
		<div class="row">
			<div class="col-md-6">
				<div class="mb-3 @if($errors->has('name')) has-error @endif ">
			      <label class="form-label" for="name">Nombre:</label>
				  <input type="text" name="name" class="form-control" placeholder="Nombre" required maxlength="200">
			      @if($errors->has('name'))<p style="color: red;" class="form-text"> {{ $errors->first('name') }} </p>  @endif
			    </div>
			    <div class="mb-3 @if($errors->has('tradename')) has-error @endif ">
			      <label class="form-label" for="tradename">Nombre comercial:</label>
				  <input type="text" name="tradename" class="form-control" placeholder="Nombre comercial" required maxlength="200">
			      @if($errors->has('tradename'))<p style="color: red;" class="form-text"> {{ $errors->first('tradename') }} </p>  @endif
			    </div>
			    <div class="mb-3 @if($errors->has('business_name')) has-error @endif ">
			      <label class="form-label" for="business_name">Razón social:</label>
				  <input type="text" name="business_name" class="form-control" placeholder="Razón social" required maxlength="200">
			      @if($errors->has('business_name'))<p style="color: red;" class="form-text"> {{ $errors->first('business_name') }} </p>  @endif
			    </div>
			    <div class="mb-3 @if($errors->has('director')) has-error @endif ">
			      <label class="form-label" for="director">Director:</label>
				  <input type="text" name="director" class="form-control" placeholder="Director" required maxlength="200">
			      @if($errors->has('director'))<p style="color: red;" class="form-text"> {{ $errors->first('director') }} </p>  @endif
			    </div>
			    <div class="mb-3 @if($errors->has('address')) has-error @endif ">
			      <label class="form-label" for="address">Dirección:</label>
				  <input type="text" name="address" class="form-control" placeholder="Dirección" required>
			      @if($errors->has('address'))<p style="color: red;" class="form-text"> {{ $errors->first('address') }} </p>  @endif
			    </div>
			    <div class="mb-3  @if($errors->has('logo')) has-error @endif ">
			      <label class="form-label" for="formInput214">Logo: (400px - 200px)</label>
			      <div style="position: relative;">
			        <input type="file" name="logo" id="logo" class="custom-file-input">
			        <span class="custom-file-control"></span>          
			      </div>
			    </div>
			    <div class="mb-3 @if($errors->has('document_type_id')) has-error @endif ">
			      <label class="form-label" for="document_type_id">Tipo de documento:</label>
			      <select class="form-control" name="document_type_id" id="document_type_id" required>
			      	@foreach($document_types as $element)
			      		<option value="{{$element->hacienda_id}}">{{$element->name}}</option>
			      	@endforeach
			      </select>
			      @if($errors->has('document_type_id'))<p style="color: red;" class="form-text"> {{ $errors->first('document_type_id') }} </p>  @endif
			    </div>
			    <div class="mb-3 @if($errors->has('document')) has-error @endif ">
			      <label class="form-label" for="document">Documento:</label>
				  <input type="text" name="document" class="form-control" placeholder="Documento" required maxlength="50">
			      @if($errors->has('document'))<p style="color: red;" class="form-text"> {{ $errors->first('document') }} </p>  @endif
			    </div>
			    <div class="mb-3 @if($errors->has('email')) has-error @endif ">
			      <label class="form-label" for="email">Correo:</label>
			      <input type="email" class="form-control" id="email" name="email" placeholder="Correo" required maxlength="255"/>
			      @if($errors->has('email'))<p style="color: red;" class="form-text"> {{ $errors->first('email') }} </p>  @endif
			    </div>
			    <div class="mb-3 @if($errors->has('geo_latitud')) has-error @endif ">
			      <label class="form-label" for="geo_latitud">Latitud:</label>
			      <input type="text" class="form-control" id="geo_latitud" name="geo_latitud" placeholder="Latitud" required maxlength="200"/>
			      @if($errors->has('geo_latitud'))<p style="color: red;" class="form-text"> {{ $errors->first('geo_latitud') }} </p>  @endif
			    </div>
			</div>
			<div class="col-md-6">
				<div class="mb-3 @if($errors->has('geo_longitud')) has-error @endif ">
			      <label class="form-label" for="geo_longitud">Longitud:</label>
			      <input type="text" class="form-control" id="geo_longitud" name="geo_longitud" maxlength="200" required title="geo_longitud"/>
			      @if($errors->has('geo_longitud'))<p style="color: red;" class="form-text"> {{ $errors->first('geo_longitud') }} </p>  @endif
			    </div>
			    <div class="mb-3 @if($errors->has('geo_country_id')) has-error @endif ">
			      <label class="form-label" for="geo_country_id">País:</label>
			      <select name="geo_country_id" id="geo_country_id" class="form-control">
			      	@foreach($geo_countries as $element)
			      		@if($element->id == $default_geo_country_id)
			      			@php
		      					$selected = "selected";
			      			@endphp
		      			@else
		      				@php
		      					$selected = "";
			      			@endphp
		      			@endif
			      		<option value="{{$element->id}}" {{$selected}}>{{$element->name}}</option>
			      	@endforeach
			      </select>
			      @if($errors->has('geo_country_id'))<p style="color: red;" class="form-text"> {{ $errors->first('geo_country_id') }} </p>  @endif
			    </div>
			    <div class="mb-3 @if($errors->has('geo_state_id')) has-error @endif ">
			      <label class="form-label" for="geo_state_id">Provincia:</label>
			      <select name="geo_state_id" id="geo_state_id" class="form-control">
			      	@foreach($geo_states as $element)
			      		<option value="{{$element->id}}">{{$element->name}}</option>
			      	@endforeach
			      </select>
			      @if($errors->has('geo_state_id'))<p style="color: red;" class="form-text"> {{ $errors->first('geo_state_id') }} </p>  @endif
			    </div>
			    <div class="mb-3 @if($errors->has('geo_region_id')) has-error @endif ">
			      <label class="form-label" for="geo_region_id">Cantón:</label>
			      <select name="geo_region_id" id="geo_region_id" class="form-control">
			      	@foreach($geo_regions as $element)
			      		<option value="{{$element->id}}">{{$element->name}}</option>
			      	@endforeach
			      </select>
			      @if($errors->has('geo_region_id'))<p style="color: red;" class="form-text"> {{ $errors->first('geo_region_id') }} </p>  @endif
			    </div>
			    <div class="mb-3 @if($errors->has('geo_district_id')) has-error @endif ">
			      <label class="form-label" for="geo_district_id">Distrito:</label>
			      <select name="geo_district_id" id="geo_district_id" class="form-control">
			      	@foreach($geo_districts as $element)
			      		<option value="{{$element->id}}">{{$element->name}}</option>
			      	@endforeach
			      </select>
			      @if($errors->has('geo_district_id'))<p style="color: red;" class="form-text"> {{ $errors->first('geo_district_id') }} </p>  @endif
			    </div>
			    <div class="mb-3 @if($errors->has('geo_suburb_id')) has-error @endif ">
			      <label class="form-label" for="geo_suburb_id">Barrio:</label>
			      <select name="geo_suburb_id" id="geo_suburb_id" class="form-control">
			      	@foreach($geo_suburbs as $element)
			      		<option value="{{$element->id}}">{{$element->name}}</option>
			      	@endforeach
			      </select>
			      @if($errors->has('geo_suburb_id'))<p style="color: red;" class="form-text"> {{ $errors->first('geo_suburb_id') }} </p>  @endif
			    </div>
			    <div class="mb-3 @if($errors->has('company_type_id')) has-error @endif ">
			      <label class="form-label" for="company_type_id">Tipo de compañía:</label>
			      <select name="company_type_id" id="company_type_id" class="form-control">
			      	@foreach($company_types as $element)
			      		<option value="{{$element->id}}">{{$element->name}}</option>
			      	@endforeach
			      </select>
			      @if($errors->has('company_type_id'))<p style="color: red;" class="form-text"> {{ $errors->first('company_type_id') }} </p>  @endif
			    </div>
			    <div class="mb-3 @if($errors->has('customer_module_id')) has-error @endif ">
			      <label class="form-label" for="customer_module_id">Licencia corporativa:</label>
			      <select name="customer_module_id" id="customer_module_id" class="form-control">
			      	@foreach($customer_modules as $element)
			      		<option value="{{$element->id}}">{{$element->organization}}</option>
			      	@endforeach
			      </select>
			      @if($errors->has('customer_module_id'))<p style="color: red;" class="form-text"> {{ $errors->first('customer_module_id') }} </p>  @endif
			    </div>
			    <div class="mb-3 @if($errors->has('customer_module_id')) has-error @endif ">
			      <label class="form-label" for="customer_module_id">Tributa:</label>
			      <select name="customer_module_id" id="customer_module_id" class="form-control">
			      	<option value="1">Si</option>
			      	<option value="2">No</option>
			      </select>
			      @if($errors->has('customer_module_id'))<p style="color: red;" class="form-text"> {{ $errors->first('customer_module_id') }} </p>  @endif
			    </div>
			    <div class="mb-3 @if($errors->has('active_id')) has-error @endif ">
			      <label class="form-label" for="active_id">Activo:</label>
			      <select name="active_id" id="active_id" class="form-control">
			      	<option value="1">Activo</option>
			      	<option value="2">Inactivo</option>
			      </select>
			      @if($errors->has('active_id'))<p style="color: red;" class="form-text"> {{ $errors->first('active_id') }} </p>  @endif
			    </div>
			</div>
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