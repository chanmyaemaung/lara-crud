@extends('posts.layout.app')

@section('content')
    {{-- Session --}}
    @php
        $session = session()->get('success');
        
        if ($session) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> ' .
                $session .
                '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    @endphp

    <div class="card shadow">
        <div class="card-header d-flex align-items-center">
            <h1 class="card-title fs-3">Trash Posts</h1>
            <div class="ms-auto">
                <a href="{{ route('posts.index') }}" class="btn btn-sm btn-secondary">Back</a>
                <a href="#" class="btn btn-sm btn-warning">Trashed</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle table-striped table-hover table-bordered table-sm text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Category</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- If there is no any posts --}}
                        @if ($posts->count() === 0)
                            <tr>
                                <td colspan="8" class="text-center">No trashed posts found!</td>
                            </tr>
                        @else
                            {{-- If there is posts --}}
                            @foreach ($posts as $post)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>
                                        <img src="{{ asset($post->image) }}" alt="{{ $post->title }}"
                                            class="img-thumbnail rounded" width="50" height="150" loading="lazy">
                                    </td>
                                    <td>{{ $post->title }}</td>
                                    <td>{!! Str::limit($post->description, 25, '...') !!}</td>
                                    <td>{{ $post->category->name }}</td>
                                    <td>{{ date('F d, Y', strtotime($post->created_at)) }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <a href="{{ route('posts.restore', $post->id) }}"
                                                class="btn btn-sm mx-1 btn-info">Restore</a>
                                            <form action="{{ route('posts.force-destroy', $post->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm mx-1 btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                {{ $posts->links() }}
            </div>
        </div>

    </div>
@endsection
