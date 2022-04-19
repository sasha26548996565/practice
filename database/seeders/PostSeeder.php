<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    private int $countPosts = 150;

    public function run()
    {
        $this->createPosts($this->countPosts);
    }

    private function createPosts(int $countPosts): void
    {
        $posts = Post::factory($countPosts)->create();

        $this->attachTags($posts);
    }

    private function attachTags(Collection $posts): void
    {
        $countIds = 10;

        foreach ($posts as $post)
        {
            $tagsIds = $this->getTagsIds($countIds);
            $post->tags()->attach($tagsIds);
        }
    }

    private function getTagsIds(int $countIds): Collection
    {
        return Tag::get()->random($countIds)->pluck('id');
    }
}
