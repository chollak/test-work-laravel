@extends('layouts.app')

@section('content')
<div class="container">
    @if($errors->any())
    <p>{{ $errors->first() }}</p>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Post Edit</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <img src="{{ asset('images/posts/'.$post->image) }}" class="img-fluid mt-3">
                        <textarea name="description" placeholder="Description"
                            required>{{ $post->description }}</textarea>
                        <button type="submit">
                            Update
                        </button>

                    </form>

                    <!-- Delete button -->
                    <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection