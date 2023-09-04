@extends('layouts.app')

@section('content')
<h3>Mantenimiento de compañía</h3>
<hr>

<div class="container-table">
  <div class="card">
    <div class="card-header">
      <strong>
        <span class="totalRows">2</span> filas encontradas, página <span class="currentPage">1</span> de <span class="totalPages">1</span>.
      </strong>
      <div class="btn-group" role="group" aria-label="...">
          <button type="button" class="btn btn-outline-secondary btnBack disabled"><span class="fa fa-chevron-left"></span></button>
          <button type="button" class="btn btn-outline-secondary btnNext disabled"><span class="fa fa-chevron-right"></span></button>
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-outline-secondary btnGoto dropdown-toggle disabled" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Ir a
            <span class="caret"></span>
            </button>
            <ul class="dropdown-menu ulPagination disabled"></ul>
          </div>
      </div>
    
      <div class="float-end">
        <a href='{{ url("/companies" . "/create") }}' class="btn btn-outline-success" title="Nuevo"><span class="fa fa-plus"></span></a>
        <!-- <a href='https://alvaro.site.co.cr/uid/1/users/excel' class="btn btn-outline-info" target="_blank" data-target="export" title="Exportar resultados a Excel" ><span class="fas fa-file-excel"></span></a> -->
      </div>
    </div>
    <div class="card-body table-responsive" id="viewResults">
      <table class="table table-hover" id="results">
        <thead>
          <tr>
           <th>Nombre</th>
           <th>Dirección</th>
           <th></th>
           <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($companies as $company)
         <tr>
           <td>{{ $company->name }}</td>
           <td>{{ $company->address }}</td>
           <td width="40"><a href="{{action('App\Http\Controllers\crud\admin\companies\CompanyController' . '@edit', [$company->id])}}" class="btn btn-outline-secondary" title="Editar"><span class="fas fa-pencil-alt"></span></a></td>
  	       <td width="40">
  	         <form action="{{action('App\Http\Controllers\crud\admin\companies\CompanyController' . '@destroy', [$company->id])}}" method="post">
  	           {{csrf_field()}}
  	           <input name="_method" type="hidden" value="DELETE">
  	           <button class="btn btn-outline-danger" type="submit" title="Borrar"><span class="fa fa-times"></span></button>
  	         </form>
  	       </td> 
         </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer">
      <strong>
        <span class="totalRows">2</span> filas encontradas, página <span class="currentPage">1</span> de <span class="totalPages">1</span>.
      </strong>
      <div class="btn-group" role="group" aria-label="...">
            <button type="button" class="btn btn-outline-secondary btnBack disabled"><span class="fa fa-chevron-left"></span></button>
            <button type="button" class="btn btn-outline-secondary btnNext disabled"><span class="fa fa-chevron-right"></span></button>
            <div class="btn-group" role="group">
              <button type="button" class="btn btn-outline-secondary btnGoto dropdown-toggle disabled" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Ir a
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu ulPagination disabled"></ul>
        </div>
        </div>
    
    
        
    
      <div class="float-end">
        <a href='{{ url("/companies" . "/create") }}' class="btn btn-outline-success" title="Nuevo"><span class="fa fa-plus "></span></a>
        <!-- <a href="https://alvaro.site.co.cr/users/excel" class="btn btn-default btnExport" target="_blank" data-target="export" title="Exportar resultados a Excel" ><span class="fa fa-file-excel-o "></span></a> -->
        <!--button class="btn btn-primary btnNew" data-target="new" title="Crear nuevo"><span class="fa fa-plus "></span></button-->
      </div>
    </div>    
  </div>
</div>

@endsection