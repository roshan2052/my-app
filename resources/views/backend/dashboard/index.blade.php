@extends('backend.layouts.master')
@section('title','Dashboard')
@section('css')

@endsection

@section('content')
    <div>
        <p>Hello {{ auth()->user()->name }}</p>
    </div>
@endsection

@section('js')

@endsection
