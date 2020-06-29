@extends('layouts.app')

@section('content')
<div class="container">
    @if($errors->any())
        <p>{{ $errors->first() }}</p>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Account</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('account.update') }}">
                        @csrf
                        @method('PATCH')
                        <div>
                            Name
                            <input type="text" name="name" value="{{ $user->name }}">
                        </div>

                        <div>
                            Email
                            <input type="email" name="email" placeholder="john.doe@example.com"
                                value="{{ $user->email }}" required>
                        </div>
                        <div>
                            Password<input type="password" name="password" required>
                            New password<input type="password" name="new_password"></div>
                        <button type="submit">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection