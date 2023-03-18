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
            <h1 class="card-title fs-3">{{ __('frontend.all_posts') }}</h1>
            <div class="ms-auto">
                @can('create', 'App\Models\Post')
                    <a href="{{ route('posts.create') }}" class="btn btn-sm btn-secondary">{{ __('frontend.create') }}</a>
                @endcan
                <a href="{{ route('posts.trashed') }}" class="btn btn-sm btn-warning">{{ __('frontend.trashed') }}</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle table-striped table-hover table-bordered table-sm text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('frontend.image') }}</th>
                            <th scope="col">{{ __('frontend.title') }}</th>
                            <th scope="col">{{ __('frontend.description') }}</th>
                            <th scope="col">{{ __('frontend.category') }}</th>
                            <th scope="col">{{ __('frontend.created_at') }}</th>
                            <th scope="col">{{ __('frontend.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- If there is no any posts --}}
                        @if ($posts->count() === 0)
                            <tr>
                                <td colspan="8" class="text-center">{{ __('frontend.no_posts_found') }}</td>
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
                                            <a href="{{ route('posts.show', $post->id) }}"
                                                class="btn btn-sm mx-1 btn-info">{{ __('frontend.show') }}</a>
                                            <a href="{{ route('posts.edit', $post->id) }}"
                                                class="btn btn-sm mx-1 btn-primary">{{ __('frontend.edit') }}</a>
                                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="btn btn-sm mx-1 btn-danger">{{ __('frontend.delete') }}</button>
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
