<div class="tab-pane show active" id="aboutme">
    {!! Form::open(['route' => 'backend.user.update_profile', 'method' => 'post', 'files' => true, 'class' => 'form-horizontal']) !!}
        <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle mr-1"></i> Personal Info</h5>
        <div class="form-group row mb-3">
            {!! Form::label('full_name', 'Full Name *', ['class' => 'col-3 col-form-label']) !!}
            <div class="col-9">
                {!! Form::text('full_name',$data['row'] ? $data['row']->full_name : auth()->user()->name , ['class' => "form-control", 'id' => 'full_name', 'placeholder' => 'Full Name']) !!}
                @include('error.single_field_validation_message',['fieldname' => 'full_name'])
            </div>
        </div>
        <div class="form-group row mb-3">
            {!! Form::label('address', 'Address *', ['class' => 'col-3 col-form-label']) !!}
            <div class="col-9">
                {!! Form::text('address',$data['row'] ? $data['row']->address : null, ['class' => "form-control", 'id' => 'address', 'placeholder' => 'Address']) !!}
                @include('error.single_field_validation_message',['fieldname' => 'address'])
            </div>
        </div>
        <div class="form-group row mb-3">
            {!! Form::label('mobile', 'Mobile *', ['class' => 'col-3 col-form-label']) !!}
            <div class="col-9">
                {!! Form::text('mobile',$data['row'] ? $data['row']->mobile : null, ['class' => "form-control", 'id' => 'mobile', 'placeholder' => 'Mobile']) !!}
                @include('error.single_field_validation_message',['fieldname' => 'mobile'])
            </div>
        </div>
        <div class="form-group row mb-3">
            {!! Form::label('email', 'Email ', ['class' => 'col-3 col-form-label']) !!}
            <div class="col-9">
                {!! Form::email('email',$data['row'] ? $data['row']->email : null, ['class' => "form-control", 'id' => 'email', 'placeholder' => 'Email']) !!}
                @include('error.single_field_validation_message',['fieldname' => 'email'])
            </div>
        </div>
        <div class="form-group row mb-3">
            {!! Form::label('dob', 'Date Of Birth', ['class' => 'col-3 col-form-label']) !!}
            <div class="col-9">
                {!! Form::date('dob',$data['row'] ? $data['row']->dob : null, ['class' => "form-control", 'id' => 'dob', 'placeholder' => 'Date Of Birth', 'max' => date('Y-m-d')]) !!}
                @include('error.single_field_validation_message',['fieldname' => 'dob'])
            </div>
        </div>
        <div class="form-group row mb-3">
            {!! Form::label('profile_image', 'Profile Image', ['class' => 'col-3 col-form-label']) !!}
            <div class="col-9">
                {!! Form::file('profile_image',null, ['class' => "form-control", 'id' => 'profile_image'])!!}
                @if (isset($data['row']->image))
                    <a href="{{ getImagePath($folder_name,$data['row']->image) }}" class="image-clean ml-4">
                        <img src="{{ getImagePath($folder_name,$data['row']->image) }}" id="preview_img" alt="Image" class="rounded-circle avatar-lg img-thumbnail" />
                    </a>
                @endif
            </div>
            @include('error.single_field_validation_message',['fieldname' => 'profile_image'])

        </div>

        <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-earth mr-1"></i> Social</h5>
        <div class="form-group row mb-3">
            {!! Form::label('facebook_url', 'Facebook', ['class' => 'col-3 col-form-label']) !!}
            <div class="col-9">
                {!! Form::url('facebook_url',$data['row'] ? $data['row']->facebook_url : null, ['class' => "form-control", 'id' => 'facebook_url', 'placeholder' => 'Facebook URL']) !!}
                @include('error.single_field_validation_message',['fieldname' => 'facebook_url'])
            </div>
        </div>
        <div class="form-group row mb-3">
            {!! Form::label('instagram_url', 'Instagram', ['class' => 'col-3 col-form-label']) !!}
            <div class="col-9">
                {!! Form::url('instagram_url',$data['row'] ? $data['row']->instagram_url : null, ['class' => "form-control", 'id' => 'instagram_url', 'placeholder' => 'Instagram URL']) !!}
                @include('error.single_field_validation_message',['fieldname' => 'instagram_url'])
            </div>
        </div>
        <div class="form-group row mb-3">
            {!! Form::label('linkedin_url', 'Linkedin', ['class' => 'col-3 col-form-label']) !!}
            <div class="col-9">
                {!! Form::url('linkedin_url',$data['row'] ? $data['row']->linkedin_url : null, ['class' => "form-control", 'id' => 'linkedin_url', 'placeholder' => 'Linkedin URL']) !!}
                @include('error.single_field_validation_message',['fieldname' => 'linkedin_url'])
            </div>
        </div>
        <div class="form-group row mb-3">
            {!! Form::label('github_url', 'GitHub', ['class' => 'col-3 col-form-label']) !!}
            <div class="col-9">
                {!! Form::url('github_url',$data['row'] ? $data['row']->github_url : null, ['class' => "form-control", 'id' => 'github_url', 'placeholder' => 'GitHub URL']) !!}
                @include('error.single_field_validation_message',['fieldname' => 'github_url'])
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-earth mr-1"></i>Short Biography - <i>Opt.</i></h5>
                    {!! Form::textarea('short_bio',$data['row'] ? $data['row']->short_bio : null, ['class' => "form-control", 'id' => 'short_bio', 'rows' => 4 , 'placeholder' => 'Write something about you...']) !!}
                    @include('error.single_field_validation_message', ['fieldname' => 'short_bio'])
                </div>
            </div>
        </div>
        <div class="text-right">
            {!! Form::button('<i class="mdi mdi-content-save"></i> Save' , ['class' => 'btn btn-success waves-effect waves-light mt-2', 'type' => 'submit']) !!}
        </div>
    {!! Form::close() !!}
</div>
