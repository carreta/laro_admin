@if(session('status') == 'saved' || session('status') == 'updated' || session('status') == 'deleted')
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <div style="color: black;">
      @if(session('status') == 'saved')
        Los datos han sido guardados con éxito.
      @elseif(session('status') == 'updated')
        Los datos han sido actualizados con éxito.
      @else
        Los datos han sido eliminados con éxito.
      @endif
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@if(session('status') == 'error')
<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
  <span class="fa-solid fa-triangle-exclamation"></span>
  &nbsp;Hubo un error al procesar su solicitud.&nbsp;Haga click 
  <strong>
    <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">&nbsp;aquí</a>
  </strong>, para reportarlo.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endif