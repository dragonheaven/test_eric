@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="col-md-12" id="app">
                    <div class="panel">
                        <div class="panel-heading border">
                            Home - Blogs
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover table-condensed responsive mb0" data-sortable="" data-sortable-initialized="true">
                                    <thead>
                                    <tr>
                                        <th width="20%">Title</th>
                                        <th width="20%">Slug</th>
                                        <th width="10%">Author</th>
                                        <th width="20%">Created At</th>
                                        <th width="20%">Updated At</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($blogs as $blog)
                                    <tr>
                                        <td><a href="/blogs/{{$blog['slug']}}/read" target="_blank">{{ $blog['title'] }}</a></td>
                                        <td>{{ $blog['slug'] }}</td>
                                        <td>{{ $blog['user']['first_name'] . ' ' . $blog['user']['last_name'] }}</td>
                                        <td>{{ $blog['created_at'] }}</td>
                                        <td>{{ $blog['updated_at'] }}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection