<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="{{  route('account.show', ['user' => $post->user->id]) }}">{{
                        '@'.$post->user->name }}</a>
                </div>

                <div class="card-body">
                    <img class="img-fluid" src="{{ asset('images/posts/'.$post->image) }}">
                    <h5>{{ $post->description }}</h5>
                    <form method="POST" action="{{ route('posts.like', ['post'=>$post->id]) }}">
                        @csrf
                        <button type="submit">
                            <span>{{ $post->likes->count()}}</span>
                        </button>
                    </form>
                    @if($post->user->id === Auth::id())
                    <a href="{{ route('posts.edit', ['post'=>$post->id]) }}">
                        Edit
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>