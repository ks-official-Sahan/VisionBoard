<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        $posts = Post::query()
            ->where('is_public', true)
            ->with(['user:id,name,profile_image_path'])
            ->latest()
            ->limit(20)
            ->get();

        return view('public.pages.index', [
            'posts' => $posts,
            'currentUserId' => optional($request->user())->id,
            'highlightPostId' => session('highlight_post_id'),
        ]);
    }
}
