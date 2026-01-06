<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostApiController extends Controller
{
    public function __construct(private readonly PostService $postService)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $posts = $this->postService->publicFeedPaginated(20);

        return response()->json([
            'status' => 'success',
            'data' => $posts,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'content' => ['required', 'string', 'max:500'],
        ]);

        $post = $this->postService->createPost($request->user(), $validated['content']);

        return response()->json([
            'status' => 'success',
            'post' => $post->load('user:id,name,profile_image_path'),
        ], 201);
    }

    public function destroy(Request $request, Post $post): JsonResponse
    {
        $deleted = $this->postService->deletePostIfOwner($request->user(), $post);

        if (! $deleted) {
            return response()->json([
                'status' => 'error',
            ], 403);
        }

        return response()->json([
            'status' => 'success',
        ]);
    }
}
