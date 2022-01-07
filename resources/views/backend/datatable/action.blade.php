<div class="datatable_action">
    @if(!empty($params['show']))
      <a class="btn btn-success mr-1" href="{{ route($params['base_route'].'show', $params['id']) }}" title="View Details"><span class="mdi mdi-eye"></span></a>
    @endif

    @if(!empty($params['edit']))
      <a class="btn btn-warning mr-1 btn-green" href="{{ route($params['base_route'].'edit', $params['id']) }}" title="Edit"><span class="mdi mdi-square-edit-outline"></span></a>
    @endif

    @if(!empty($params['delete']))
      {!! Form::open(['route' => [$params['base_route'].'destroy', $params['id']], 'class' => 'form-inline', 'method' => 'delete']) !!}
        <button type="button" class="btn btn-danger trash-bcolor delete-confirm"  title="Delete"><span class="fas fa-trash"></span></button>
      {!! Form::close() !!}
    @endif
</div>

