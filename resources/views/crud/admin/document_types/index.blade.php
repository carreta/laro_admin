@extends('layouts.app')

@section('content')
<h3>{{$view_fields->view_name}}</h3>
<hr>

<x-alert :item="session('status')" :incident="$incident" />

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
    
    <x-table :collection="$collection" :fieldnames="$field_names" :tablenames="$table_names" :controller="$controller"  />

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
@endsection