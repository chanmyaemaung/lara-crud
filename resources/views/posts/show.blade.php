@extends('posts.layout.app')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card shadow">
                <img src="{{ asset($post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                <div class="card-header d-flex align-items-center">
                    <h1 class="card-title fs-3">{{ $post->title }}</h1>
                    <div class="ms-auto">
                        <a href="{{ route('posts.index') }}" class="btn btn-sm btn-secondary">Back</a>
                    </div>
                </div>
                <div class="card-body text-justify">
                    {!! $post->description !!}
                </div>
                <div class="card-footer text-muted text-center">
                    {{ $post->created_at->diffForHumans() }}
                  </div>
            </div>
        </div>
    </div>
@endsection
