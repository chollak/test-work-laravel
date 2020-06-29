<?php

namespace App\Http\Controllers;

use App\User;
use App\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function settings()
    {
        return view('users.account', [
            'user' => User::findOrFail(Auth::id()),
        ]);
    }

    public function show($id)
    {
        return view('users.user', [
            'user' => User::with(['posts', 'posts.likes'])->find($id),
            'followed' => Follow::where([
                ['user_1', Auth::id()],
                ['user_2', $id],
            ])->exists(),
        ]);
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
            'new_password' => 'nullable|string|min:6|different:password',
            ]);

        strlen($request->name) > 0 ? $user->name = $request->name : '';
        strlen($request->new_password) > 0 ? $user->password = Hash::make($request->new_password) : '';
        
        $user->save();

        return redirect('user/'.Auth::id());
    }


    public function follow($id)
    {
        $data = Follow::where([
            ['user_1', Auth::id()],
            ['user_2', $id],
        ]);

        if (null === $data->first()) {
            $follow = new Follow();
            $follow->user_1 = Auth::id();
            $follow->user_2 = $id;
            $follow->save();
        } else {
            $data->delete();
        }

        return redirect()->route('account.show', ['user' => $id]);
    }
}
