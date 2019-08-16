<?php


namespace App\Repositories\Rpg;


use App\Post;

interface PostRepositoryInterface
{
    /**
     * Create a post
     *
     * @param $post_data array Post data
     * @return Post
    */
    public function create($post_data);

    /**
     * Update a post
     *
     * @param $post_id int Post's ID
     * @param $post_data array New data for post
    */
    public function update($post_id, $post_data);

    /**
     * Delete a post
     *
     * @param $post_id int Post's ID
    */
    public function delete($post_id);

    /**
     * Get several last posts
     *
     * @param $limit int Limit of lasts posts
     * @return mixed
    */
    public function getLastPosts(int $limit);
}
