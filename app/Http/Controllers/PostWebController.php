<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostWebController extends Controller
{
    public function __construct(private readonly PostService $postService)
    {
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'content' => ['required', 'string', 'max:500'],
        ]);

        $post = $this->postService->createPost($request->user(), $validated['content']);

        return redirect()->route('home')
            ->with('highlight_post_id', $post->id);
    }

    public function destroy(Request $request, Post $post): RedirectResponse
    {
        $deleted = $this->postService->deletePostIfOwner($request->user(), $post);

        if (! $deleted) {
            return redirect()->route('home');
        }

        return redirect()->route('home');
    }
}
