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