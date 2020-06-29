@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User</div>

                <div class="card-body">
                    <div>
                        {{$user->name}}
                    </div>
                    <div>
                        @if($user->id !== Auth::id())
                        <form method="POST" action="{{ route('account.follow', ['user'=>$user->id]) }}" class="w100">
                            @csrf
                            @if(!$followed)
                            <input type="submit" class="button is-link is-outlined is-fullwidth"
                                value="{{ __('Follow') }}">
                            @else
                            <input type="submit" class="button is-danger is-outlined is-fullwidth"
                                value="{{ __('Unfollow') }}">
                            @endif
                        </form>
                        @else
                        <a href="{{ route('account') }}" class="button is-dark is-outlined is-fullwidth"><span
                                class="icon"><i class="fas fa-cog"></i></span><span>{{
                                __('Settings') }}</span></a>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col">
                            @if(count($user->posts) > 0)
                            @foreach($user->posts as $post)
                            @include('layouts.post', $post)
                            @endforeach
                            @else
                            @include('posts.empty')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection