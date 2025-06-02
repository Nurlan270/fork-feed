<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserBookmarksController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $bookmarks = auth()->user()->bookmarks()->get();

        return view('user.bookmarks', compact('bookmarks'));
    }
}
