<div class="card-body table-responsive" id="viewResults">
  <table class="table table-hover" id="results">
    <thead>
      <tr>
        @foreach($fieldnames as $element)
          @if($element != 'Id')
            <th>{{$element}}</th>
          @endif
        @endforeach
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @for($i = 0; $i < count($collection); $i++)
        <tr>
          @for($j = 0; $j < count($tablenames); $j++)
              @if($tablenames[$j] != 'id')
                <td>{{ $collection[$i][$tablenames[$j]] }}</td>
              @endif
            @php
              $id = $collection[$i][$tablenames[0]];
            @endphp
          @endfor
          <td width="40">
            <a href="{{action($controller . '@edit', [$id])}}" class="btn btn-outline-secondary" title="Editar">
              <span class="fas fa-pencil-alt"></span>
            </a>
          </td>
          <td width="40">
          <form action="{{action($controller . '@destroy', [$id])}}" method="post">
            {{csrf_field()}}
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-outline-danger" type="submit" title="Borrar"><span class="fa fa-times"></span></button>
          </form>
        </tr>
      @endfor
    </tbody>
  </table>
</div>