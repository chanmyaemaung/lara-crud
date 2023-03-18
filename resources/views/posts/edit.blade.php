@extends('posts.layout.app')



@section('content')
    @foreach ($errors->all() as $error)
        <div class="alert alert-primary" role="alert">
            {{ $error }}
        </div>
    @endforeach

    <div class="card shadow">
        <div class="card-header d-flex align-items-center">
            <h1 class="card-title fs-3">Edit Post</h1>
            <div class="ms-auto">
                <a href="{{ route('posts.index') }}" class="btn btn-sm btn-secondary">Back</a>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="title" name="title" class="form-control" id="title" aria-describedby="postTitle"
                        value="{{ $post->title }}">
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select" name="category" id="floatingSelect"
                        aria-label="Floating label select example">
                        <option selected>Select</option>
                        @foreach ($categories as $category)
                            <option {{ $post->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" id="image" aria-describedby="postImage">
                </div>
                <div class="mb-3">
                    <img src="{{ asset($post->image) }}" class="img-thumbnail" alt="{{ $post->title }}" width="150"
                        title="{{ $post->image }}">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">
                        {{ $post->description }}
                    </textarea>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-secondary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection