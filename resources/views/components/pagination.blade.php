<strong>
    <span class="totalRows">{{ $item->total() }}</span> filas encontradas, página <span class="currentPage">{{ $item->currentPage() }}</span> de <span class="totalPages">{{ $item->lastPage() }}</span>
</strong>
<div class="btn-group" role="group" aria-label="...">
    @if($item->onFirstPage())
      <button type="button" class="btn btn-outline-secondary btnBack disabled"><span class="fa fa-chevron-left"></span></button>
      <a class="btn btn-outline-secondary btnNext" href="{{ $item->nextPageUrl() }}" rel="next"><span class="fa fa-chevron-right"></span></a>
    @else
      @if($item->lastPage() && $item->hasMorePages())
        <a class="btn btn-outline-secondary btnBack" href="{{ $item->previousPageUrl() }}" rel="prev"><span class="fa fa-chevron-left"></span></a>
        <a class="btn btn-outline-secondary btnNext" href="{{ $item->nextPageUrl() }}" rel="next"><span class="fa fa-chevron-right"></span></a>
      @else
        <a class="btn btn-outline-secondary btnBack" href="{{ $item->previousPageUrl() }}" rel="prev"><span class="fa fa-chevron-left"></span></a>
        <a class="btn btn-outline-secondary btnNext disabled" href="{{ $item->nextPageUrl() }}" rel="next"><span class="fa fa-chevron-right"></span></a>
      @endif
    @endif        

    <div class="btn-group" role="group">
      <button type="button" class="btn btn-outline-secondary btnGoto dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="caret">Ir a</span>
      </button>
      <ul class="dropdown-menu">
        @for($i = 1; $i <= $item->lastPage(); $i++)
          <li><a class="dropdown-item" href="?page={{$i}}">Página {{$i}}</a></li>
        @endfor            
      </ul>
    </div>
</div>