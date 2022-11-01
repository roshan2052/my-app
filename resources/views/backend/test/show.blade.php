@extends('backend.layouts.master')
@section('title',$page_title)

@section('css')
    <link href="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title space_create">{{ $page_title }}
                    <span class="custom_view_pull">
                        <a href="{{route($base_route . 'create')}}" class="btn btn-success custom_btn_cl m-left-20 btn-green"><i class="fas fa-pencil-alt text-light mr-2"></i>Create</a>
                        <a href="{{route($base_route . 'index')}}" class="btn btn-info custom_btn_cl btn-purple"><i class="fas fa-list text-light mr-2"></i>List</a>
                    </span>
                </h4>
                <hr class="custom_hr">
                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap">
                    <tr>
                        <th>Title</th>
                        <td>{{ $data['row']->title }}</td>
                    </tr>
                    <tr>
                        <th>Key</th>
                        <td>{{ $data['row']->key ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Created Date</th>
                        <td>{{ $data['row']->created_at }}</td>
                    </tr>
                    <tr>
                        <th>Updated Date</th>
                        <td>{{ $data['row']->updated_at ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Created By</th>
                        <td>{{ $data['row']->createdBy->name }}</td>
                    </tr>
                    <tr>
                        <th>Updated By</th>
                        <td>{{ $data['row']->updatedBy->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>
                            <a class="btn  btn-warning mr-right-5 btn-green" href="{{ route($base_route.'edit', $data['row']->id) }}" title="Edit"><span class="mdi mdi-square-edit-outline"></span> Edit</a>
                        </td>
                        <td>
                            {!! Form::open(['route' => [$base_route.'destroy', $data['row']->id], 'class' => 'form-inline','method' => 'delete']) !!}
                                <button type="submit" class="btn btn-danger trash-bcolor delete-confirm" title="Delete"><span class="fas fa-trash"></span> Delete</button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
@endsection
