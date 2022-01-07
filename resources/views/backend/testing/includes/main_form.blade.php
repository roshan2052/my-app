@if($page == 'create')
  {!! Form::open(['route' => $route, 'method' => 'post', 'files' => true , 'class' => 'form-horizontal data-parsley-validate custom_form']) !!}
@else
  {!! Form::model($data['row'],['route' => [$route, $data['row']->id], 'method' => 'put','files' => true]) !!}
  {!! Form::hidden('id', null) !!}
@endif

<div class="form-group row mb-3">
    {!! Form::label('test_id', 'Test *', ['class' => 'col-3 col-form-label']) !!}
    <div class="col-9">
    {!! Form::select('test_id', $data['tests'] , null, ['class' => "form-control", 'id' => 'test_id', 'placeholder' => 'Select Test']) !!}
    @include('error.single_field_validation_message',['fieldname' => 'test_id'])
    </div>
</div>

<div class="form-group row mb-3">
    {!! Form::label('title', 'Title *', ['class' => 'col-3 col-form-label']) !!}
    <div class="col-9">
    {!! Form::text('title', null, ['class' => "form-control", 'id' => 'title', 'placeholder' => 'Title']) !!}
    @include('error.single_field_validation_message',['fieldname' => 'title'])
    </div>
</div>

<div class="form-group row mb-3">
    {!! Form::label('image_name', 'Image', ['class' => 'col-3 col-form-label']) !!}
    <div class="col-9">
        {!! Form::file('image_name',null, ['class' => "form-control", 'id' => 'image_name'])!!}
        @if (isset($data['row']->image))
            <a href="{{ getImagePath($folder_name,$data['row']->image) }}" class="ml-1">
                <img src="{{ getImagePath($folder_name,$data['row']->image) }}" alt="Image" class="rounded-circle avatar-lg img-thumbnail" />
            </a>
        @endif
    </div>
    @include('error.single_field_validation_message',['fieldname' => 'image_name'])
</div>


<div class="form-group row mb-3">
    {!! Form::label('status', 'Status', ['class' => 'col-3 col-form-label', 'for' => '' ]) !!}
    <div class="col-9">
    <div class="radio radio-primary form-check-inline">
        {!! Form::radio('status','publish',true,['id' => 'statusRadio1']) !!}
        <label for="inlineRadio1"> Publish </label>
    </div>
    <div class="radio radio-danger form-check-inline">
        {!! Form::radio('status','un-publish',false,['id' => 'statusRadio2']) !!}
        <label for="inlineRadio1"> Unpublish </label>
    </div>
    </div>
</div>

<div class="form-group mb-0 justify-content-end row">
    <div class="col-9">
    {!! Form::button('<i class="fas fa-save"></i> Save' , ['class' => 'btn btn-info btn-green ', 'type' => 'submit']) !!}
    {!! Form::button('<i class="fas fa-redo-alt"></i> Reset' , ['class' => 'btn btn-danger trash-bcolor', 'type' => 'reset']) !!}
    </div>
</div>

{!! Form::close() !!}
