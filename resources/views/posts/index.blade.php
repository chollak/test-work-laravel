@extends('layouts.app')

@section('content')
@if(count($posts) > 0)
@foreach($posts as $post)
@include('layouts.post', $post)
@endforeach
@else
@include('posts.empty')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Posts</div>

                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection