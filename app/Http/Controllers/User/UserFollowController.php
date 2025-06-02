<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserFollowController extends Controller
{
    public function following(User $user)
    {
        $following = $user->following()->get();

        return view('user.following', compact('user', 'following'));
    }

    public function followers(User $user)
    {
        $followers = $user->followers()->get();

        return view('user.followers', compact('user', 'followers'));
    }
}
