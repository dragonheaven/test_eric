@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading border">
                            {{ $blog->title }}
                        </div>
                        <div class="panel-body">
                            <p>
                                {!! $blog->content !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection