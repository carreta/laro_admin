@extends('layouts.app')

@section('content')
<h3>Mantenimiento de tipos de documentos</h3>
<hr>

<div class="container-table">
  <div class="card">
    <div class="card-header">
      <x-pagination :item="$document_types"/>
    
      <div class="float-end">
        @can('crud.admin.document_types.index')
          <a href='{{ url("/document_types" . "/create") }}' class="btn btn-outline-success" title="Nuevo"><span class="fa fa-plus"></span></a>
        @endcan
        <!-- <a href='https://alvaro.site.co.cr/uid/1/users/excel' class="btn btn-outline-info" target="_blank" data-target="export" title="Exportar resultados a Excel" ><span class="fas fa-file-excel"></span></a> -->
      </div>
    </div>
    <div class="card-body table-responsive" id="viewResults">
      <table class="table table-hover" id="results">
        <thead>
          <tr>
           <th>Nombre</th>
           <th></th>
           <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($document_types as $element)
            <tr>
              <td>{{ $element->name }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer">
      <x-pagination :item="$document_types"/>
      
      <div class="float-end">
        @can('crud.admin.document_types.index')
          <a href='{{ url("/document_types" . "/create") }}' class="btn btn-outline-success" title="Nuevo"><span class="fa fa-plus"></span></a>
        @endcan
        <!-- <a href="https://alvaro.site.co.cr/users/excel" class="btn btn-default btnExport" target="_blank" data-target="export" title="Exportar resultados a Excel" ><span class="fa fa-file-excel-o "></span></a> -->
        <!--button class="btn btn-primary btnNew" data-target="new" title="Crear nuevo"><span class="fa fa-plus "></span></button-->
      </div>
    </div>    
  </div>
</div>

@endsection