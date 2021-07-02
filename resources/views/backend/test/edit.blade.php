@extends('backend.layouts.master')
@section('title', $page_title)
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">{{$page_title}}
                    <a href="{{route($base_route . 'create')}}" class="btn btn-success custom_btn_cl m-left-20 btn-green"><i class="fas fa-pencil-alt text-light mr-2"></i>Create</a>
                    <a href="{{route($base_route . 'index')}}" class="btn btn-info custom_btn_cl btn-purple"><i class="fas fa-list text-light mr-2"></i>List</a>
                </h4>
                <hr class="custom_hr">
                @include($view_path.'.includes.main_form',['route' => $base_route . 'update', 'method' => 'put','files' => true,'button' => 'Update','page' => 'edit'])
            </div>
        </div>
    </div>
@endsection

