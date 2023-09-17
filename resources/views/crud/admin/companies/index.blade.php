@extends('layouts.app')

@section('content')
<br>
<div class="row">
  <div class="col-md-6">
    <h3>{{$view_fields->view_name}}</h3>  
  </div>
  <div class="col-md-6">
    <button id="btn_search" onclick="removeClass()" class="btn btn-outline-info float-end"><span class="fas fa-search"></span></button>
  </div>
</div>

@php
  
  $class = 'hide';
  $show_search_customer = true;
  $customer_form = null;
  $email_form = null;

  if($show_search_customer == 'true'){
    $class = '';
  }

  $customer_disabled = '';
  $customer_check = 'checked';
  if($customer_form == null){
    $customer_disabled = '';
    $customer_check = '';
  }

  $email_disabled = '';
  $email_check = 'checked';
  if($email_form == null){
    $email_disabled = '';
    $email_check = '';
  }
@endphp
<div class="d-none" id="search_customer">
  <form method="GET" action="{{action($controller . '@index')}}" accept-charset="UTF-8">
    <div class="container">    
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <div class="custom-control custom-checkbox" style="margin-bottom: .5rem!important;">
              <input type="checkbox" {{$customer_check}} data-target="name" class="custom-control-input checkbox" name="check_customer" id="check_customer">
              <label class="custom-control-label" for="check_customer">Nombre:</label>
            </div>
            <input type="text" name="name" id="name" value="{{$customer_form}}" class="form-control" {{$customer_disabled}}>
          </div>
        </div>
        <div class="col-md-6  ">
          <div class="form-group">
            <div class="custom-control custom-checkbox" style="margin-bottom: .5rem!important;">
              <input type="checkbox" {{$email_check}} data-target="email" class="custom-control-input checkbox" name="check_email" id="check_email">
              <label class="custom-control-label" for="check_email">Correo:</label>
            </div>
            <input type="text" name="email" id="email" value="{{$email_form}}" class="form-control" {{$email_disabled}}>
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-12 text-center">
          <button type="submit" class="btn btn-primary"><span class="fas fa-search"></span> Buscar</button>      
        </div>
      </div>
    </div>
  </form>
  <br>
</div>


<hr>

<x-alert :item="session('status')" />

<div class="container-table">
  <div class="card">
    <div class="card-header">
      <x-pagination :collection="$collection" :searchparameters="$search_parameters"/>
    
      <div class="float-end">
        @can($permissions[1])
          <a href='{{ url("/$view_fields->route" . "/create") }}' class="btn btn-outline-success" title="Nuevo"><span class="fa fa-plus"></span></a>
        @endcan
      </div>
    </div>
    
    <x-table :collection="$collection" :fieldnames="$field_names" :tablenames="$table_names" :controller="$controller" />

    <div class="card-footer">
      <x-pagination :collection="$collection" :searchparameters="$search_parameters"/>
      
      <div class="float-end">
        @can($permissions[1])
          <a href='{{ url("/$view_fields->route" . "/create") }}' class="btn btn-outline-success" title="Nuevo"><span class="fa fa-plus"></span></a>
        @endcan
      </div>
    </div>    
  </div>
</div>

<script type="text/javascript">
  function removeClass(){
    console.log("Funciona");
    var e = document.getElementById('search_customer');
    e.classList.remove("d-none");
  }
</script>
@endsection