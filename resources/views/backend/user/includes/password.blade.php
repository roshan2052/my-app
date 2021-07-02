<div class="tab-pane" id="password">
    {!! Form::open(['route' =>'backend.user.change_password', 'method' => 'post', 'files' => true, 'class' => 'form-horizontal', 'id' => 'main_form']) !!}
        <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle mr-1"></i> Change your password</h5>
        <div class="form-group row mb-3">
            {!! Form::label('old_password', 'Old password', ['class' => 'col-3 col-form-label']) !!}
            <div class="col-9">
                {!! Form::password('old_password', ['class' => "form-control", 'id' => 'old_password', 'placeholder' => 'Old Password']) !!}
                @include('error.single_field_validation_message',['fieldname' => 'old_password'])
            </div>
        </div>
        <div class="form-group row mb-3">
            {!! Form::label('new_password', 'New password', ['class' => 'col-3 col-form-label']) !!}
            <div class="col-9">
                {!! Form::password('new_password', ['class' => "form-control", 'id' => 'new_password', 'placeholder' => 'New Password']) !!}
                @include('error.single_field_validation_message',['fieldname' => 'new_password'])
            </div>
        </div>
        <div class="form-group row mb-3">
            {!! Form::label('new_password_confirmation', 'Confirm password', ['class' => 'col-3 col-form-label']) !!}
            <div class="col-9">
                {!! Form::password('new_password_confirmation', ['class' => "form-control", 'id' => 'new_password_confirmation', 'placeholder' => 'Confirm Password']) !!}
                @include('error.single_field_validation_message',['fieldname' => 'new_password_confirmation'])
            </div>
        </div>
        <div class="text-right">
            {!! Form::button('<i class="mdi mdi-content-save"></i> Save' , ['class' => 'btn btn-success waves-effect waves-light', 'type' => 'submit']) !!}
        </div>
    {!! Form::close() !!}
</div>
