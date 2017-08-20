@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="col-md-12" id="app">
                    <user-list></user-list>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/vendor/chosen_v1.4.0/chosen.min.css">
    <link rel="stylesheet" href="/vendor/sweetalert/lib/sweet-alert.css">
@endsection

@section('js')
    <script src="/vendor/chosen_v1.4.0/chosen.jquery.min.js"></script>
    <script src="/vendor/sweetalert/lib/sweet-alert.min.js"></script>
    <script>
        window.timezones = [
            @foreach($timezones as $timezone)
                '{{$timezone}}',
            @endforeach
        ];
    </script>
    <script src="/scripts/pages/users/users.js"></script>
@endsection