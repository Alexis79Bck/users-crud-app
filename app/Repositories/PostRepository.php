<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Collection;
class PostRepository
{
    /**
     * Get all posts.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return Post::all();
    }

    /**
     * Find a post by ID.
     *
     * @param int $id
     * @return Post|null
     */
    public function find(int $id): ?Post
    {
        return Post::find($id);
    }

    /**
     * Create a new post.
     *
     * @param array $data
     * @return Post
     */
    public function create(array $data): Post
    {
        return Post::create($data);
    }

    /**
     * Update a post.
     *
     * @param int $id
     * @param array $data
     * @return Post|null
     */
    public function update(int $id, array $data): ?Post
    {
        $post = $this->find($id);
        if ($post) {
            $post->update($data);
        }
        return $post;
    }

    /**
     * Delete a post.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $post = $this->find($id);
        if ($post) {
            return $post->delete();
        }
        return false;
    }
}