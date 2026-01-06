<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PostService
{
    /**
     * Get latest public posts for the home feed.
     */
    public function publicFeedPaginated(int $perPage = 20): LengthAwarePaginator
    {
        return Post::query()
            ->where('is_public', true)
            ->with(['user:id,name,profile_image_path'])
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Get a simple collection of latest public posts (for web home page).
     */
    public function publicFeed(int $limit = 20): Collection
    {
        return Post::query()
            ->where('is_public', true)
            ->with(['user:id,name,profile_image_path'])
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Create a new public post for the given user.
     */
    public function createPost(User $user, string $content): Post
    {
        return Post::create([
            'user_id' => $user->id,
            'content' => $content,
            'is_public' => true,
        ]);
    }

    /**
     * Delete a post if it belongs to the given user.
     */
    public function deletePostIfOwner(User $user, Post $post): bool
    {
        if ($post->user_id !== $user->id) {
            return false;
        }

        $post->delete();

        return true;
    }
}
