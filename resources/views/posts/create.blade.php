@extends('layouts.app')

@section('content')
<div class="container">
    @if($errors->any())
    <p>{{ $errors->first() }}</p>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Post Create</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div><input type="file" name="image"></div>
                        <div><textarea name="description" placeholder="Description" maxlength="128" required></textarea>
                        </div>
                        <button type="submit">
                            Create
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection