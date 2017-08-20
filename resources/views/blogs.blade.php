@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="col-md-12" id="app">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/vendor/sweetalert/lib/sweet-alert.css">
    <link rel="stylesheet" href="/styles/summernote.css">
@endsection

@section('js')
    <script src="/vendor/sweetalert/lib/sweet-alert.min.js"></script>
    <script src="/scripts/summernote.min.js"></script>
    <script src="/scripts/pages/blogs/blogs.js"></script>
@endsection