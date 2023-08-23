@extends('layouts.app')

@section('content')
<h3>Mantenimiento de tipos de documentos</h3>
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
        <a href='{{ url("/document_types" . "/create") }}' class="btn btn-outline-success" title="Nuevo"><span class="fa fa-plus"></span></a>
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
          <tr>
            <td>{{ $this->name }}</td>
          </tr>
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
        <a href='{{ url("/document_types" . "/create") }}' class="btn btn-outline-success" title="Nuevo"><span class="fa fa-plus "></span></a>
        <!-- <a href="https://alvaro.site.co.cr/users/excel" class="btn btn-default btnExport" target="_blank" data-target="export" title="Exportar resultados a Excel" ><span class="fa fa-file-excel-o "></span></a> -->
        <!--button class="btn btn-primary btnNew" data-target="new" title="Crear nuevo"><span class="fa fa-plus "></span></button-->
      </div>
    </div>    
  </div>
</div>

@endsection