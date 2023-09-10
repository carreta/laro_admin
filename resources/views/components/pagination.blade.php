<strong>
    <span class="totalRows">{{ $collection->total() }}</span> filas encontradas, página <span class="currentPage">{{ $collection->currentPage() }}</span> de <span class="totalPages">{{ $collection->lastPage() }}.</span>
</strong>
<div class="btn-group" role="group" aria-label="...">
    @if($collection->onFirstPage())
      @if($collection->hasMorePages())
        <button type="button" class="btn btn-outline-secondary btnBack disabled"><span class="fa fa-chevron-left"></span></button>
        <a class="btn btn-outline-secondary btnNext" href="{{ $collection->nextPageUrl() }}" rel="next"><span class="fa fa-chevron-right"></span></a>
      @else
        <button type="button" class="btn btn-outline-secondary btnBack disabled"><span class="fa fa-chevron-left"></span></button>
        <a class="btn btn-outline-secondary btnNext disabled" href="#" rel="next"><span class="fa fa-chevron-right"></span></a>
      @endif
    @else
      @if($collection->lastPage() && $collection->hasMorePages())
        <a class="btn btn-outline-secondary btnBack" href="{{ $collection->previousPageUrl() }}" rel="prev"><span class="fa fa-chevron-left"></span></a>
        <a class="btn btn-outline-secondary btnNext" href="{{ $collection->nextPageUrl() }}" rel="next"><span class="fa fa-chevron-right"></span></a>
      @else
        <a class="btn btn-outline-secondary btnBack" href="{{ $collection->previousPageUrl() }}" rel="prev"><span class="fa fa-chevron-left"></span></a>
        <a class="btn btn-outline-secondary btnNext disabled" href="{{ $collection->nextPageUrl() }}" rel="next"><span class="fa fa-chevron-right"></span></a>
      @endif
    @endif        

    <div class="btn-group" role="group">
      @if($collection->hasMorePages() || $collection->lastPage() > 1)
        <button type="button" class="btn btn-outline-secondary btnGoto dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          <span class="caret">Ir a</span>
        </button>
      @else
        <button type="button" class="btn btn-outline-secondary btnGoto dropdown-toggle disabled" data-bs-toggle="dropdown" aria-expanded="false">
          <span class="caret">Ir a</span>
        </button>
      @endif
      <ul class="dropdown-menu">
        @for($i = 1; $i <= $collection->lastPage(); $i++)
          <li><a class="dropdown-item" href="?page={{$i}}">Página {{$i}}</a></li>
        @endfor            
      </ul>
    </div>
</div>