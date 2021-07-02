@if($page == 'create')
  {!! Form::open(['route' => $route, 'method' => 'post', 'files' => true , 'class' => 'form-horizontal data-parsley-validate custom_form']) !!}
@else
  {!! Form::model($data['row'],['route' => [$route, $data['row']->id], 'method' => 'put','files' => true]) !!}
  {!! Form::hidden('id', null) !!}
@endif

<div class="form-group row mb-3">
    {!! Form::label('title', 'Title *', ['class' => 'col-3 col-form-label']) !!}
    <div class="col-9">
    {!! Form::text('title', null, ['class' => "form-control", 'id' => 'title', 'placeholder' => 'Title']) !!}
    @include('error.single_field_validation_message',['fieldname' => 'title'])
    </div>
</div>

<div class="form-group row mb-3">
    {!! Form::label('key', 'Key *', ['class' => 'col-3 col-form-label']) !!}
    <div class="col-9">
    {!! Form::text('key', null, ['class' => "form-control", 'id' => 'key', 'placeholder' => 'key']) !!}
    @include('error.single_field_validation_message',['fieldname' => 'key'])
    </div>
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
