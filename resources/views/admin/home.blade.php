@extends('layouts.front')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a class="btn btn-primary" href="{{ route('admin.posts.index') }}">
                        All Post
                    </a>

                    <a class="btn btn-primary" href="{{ route('admin.posts.myindex') }}">
                        My Post
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
