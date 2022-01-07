@extends('backend.layouts.master')
@section('title','Dashboard')

@section('content')

    <div class="col-lg-4 col-xl-4">
        <div class="card-box text-center">

            @if (isset($data['row']->image))
                <img src="{{ getImagePath($folder_name,$data['row']->image) }}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
            @else
                <img src="{{ asset('backend/assets/images/users/user.png') }}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
            @endif

            <h4 class="mb-0">{{ $data['row'] ? $data['row']->full_name : auth()->user()->name }}</h4>

            <div class="text-left mt-3">

                <p class="text-muted mb-2 font-13"><strong>Address :</strong> <span class="ml-2">{{ $data['row'] ? $data['row']->address : 'N/A' }}</span></p>

                <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ml-2">{{ $data['row'] ? $data['row']->mobile : 'N/A' }}</span></p>

                <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 ">{{ $data['row'] ? $data['row']->email ?? 'N/A' : 'N/A' }}</span></p>

                <h4 class="font-13 text-uppercase">About Me :</h4>

                <p class="text-muted font-13 mb-3">{{ $data['row'] ? $data['row']->short_bio ?? 'N/A' : 'N/A' }}</p>
            </div>

            <ul class="social-list list-inline mt-3 mb-0">
                <li class="list-inline-item">
                    <a target="_blank" href="{{ $data['row'] ? $data['row']->facebook_url : '#' }}" class="social-list-item border-primary text-primary">
                        <i class="mdi mdi-facebook"></i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a target="_blank" href="{{ $data['row'] ? $data['row']->instagram_url : '#' }}" class="social-list-item border-info text-info">
                        <i class="mdi mdi-instagram"></i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a target="_blank" href="{{ $data['row'] ? $data['row']->linkedin_url : '#' }}" class="social-list-item border-danger text-danger"><i
                        class="mdi mdi-linkedin"></i></a>
                </li>
                <li class="list-inline-item">
                    <a target="_blank" href="{{ $data['row'] ? $data['row']->github_url : '#' }}" class="social-list-item border-secondary text-secondary">
                        <i class="mdi mdi-github-circle"></i>
                    </a>
                </li>
            </ul>
        </div> <!-- end card-box -->

    </div> <!-- end col-->

    <div class="col-lg-8 col-xl-8">
        <div class="card-box">
            <ul class="nav nav-pills navtab-bg nav-justified">
                <li class="nav-item">
                    <a href="#aboutme" data-toggle="tab" aria-expanded="false" class="nav-link active">
                        About Me
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#password" data-toggle="tab" aria-expanded="true" class="nav-link">
                        Password
                    </a>
                </li>
            </ul>
            <div class="tab-content">

                @include($view_path.'.includes.about_me')
                <!-- end about me section content -->

                @include($view_path.'.includes.password')
                <!-- end password content-->

            </div> <!-- end tab-content -->
        </div> <!-- end card-box-->

    </div> <!-- end col -->

@endsection

@section('js')
    @include($view_path.'.includes.script')
@endsection


