<?php

namespace Tests\Feature\Web;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\WebDomain;

class PostsTest extends TestCase
{
    use RefreshDatabase, WebDomain;

    protected function getPostData(array $override = []): array
    {
        if (!array_key_exists('category_id', $override)) {
            $override['category_id'] = factory(Category::class)->create()->id;
        }

        return array_merge([
            'title' => 'Test Post',
            'description' => 'Test Description',
            'link' => 'https://test.com',
            'category_id' => $override['category_id'],
            'tags' => 'test tag'
        ], $override);
    }

    /** @test */
    public function user_can_visit_the_posts_homepage()
    {
        $posts = factory(Post::class, 10)->create(['status' => Post::STATUS_ACCEPTED]);


        $response = $this->get("/");


        $response->assertSuccessful();
        $response->assertViewIs('web.posts.index');
        $response->assertSeeInOrder($posts->pluck('name')->toArray());
    }

    /** @test */
    public function posts_homepage_will_be_paginated()
    {
        $posts = factory(Post::class, 20)->create(['status' => Post::STATUS_ACCEPTED]);


        $response = $this->get("/?page=2");


        $response->assertSuccessful();
        $response->assertViewIs('web.posts.index');
        $response->assertSeeInOrder($posts->slice(10)->pluck('name')->toArray());
    }

    /** @test */
    public function user_can_search_for_posts_by_title()
    {
        $relevantPosts = collect([
            factory(Post::class)->create(['title' => 'Test Post 1', 'status' => Post::STATUS_ACCEPTED]),
            factory(Post::class)->create(['title' => 'Post Test 2', 'status' => Post::STATUS_ACCEPTED]),
            factory(Post::class)->create(['title' => 'Post Another Test', 'status' => Post::STATUS_ACCEPTED]),
        ]);

        $irrelevantPosts = collect([
            factory(Post::class)->create(['title' => 'Invisible 1', 'status' => Post::STATUS_ACCEPTED]),
            factory(Post::class)->create(['title' => 'Invisible 2', 'status' => Post::STATUS_ACCEPTED]),
            factory(Post::class)->create(['title' => 'Invisible 3', 'status' => Post::STATUS_ACCEPTED]),
        ]);


        $response = $this->get("/?search=test post");


        $response->assertSuccessful();
        $response->assertViewIs('web.posts.index');
        $response->assertSeeInOrder($relevantPosts->pluck('title')->toArray());
        $irrelevantPosts->each(function (Post $post) use ($response) {
            $response->assertDontSee($post->title);
        });
    }

    /** @test */
    public function user_can_search_for_posts_by_category()
    {
        $relevantCategory = factory(Category::class)->create();
        $relevantPosts = factory(Post::class, 3)->create(['category_id' => $relevantCategory->id, 'status' => Post::STATUS_ACCEPTED]);

        $irrelevantPosts = factory(Post::class, 3)->create(['category_id' => factory(Category::class)->create()->id, 'status' => Post::STATUS_ACCEPTED]);


        $response = $this->get("/?category={$relevantCategory->id}");


        $response->assertSuccessful();
        $response->assertViewIs('web.posts.index');
        $response->assertSeeInOrder($relevantPosts->pluck('title')->toArray());
        $irrelevantPosts->each(function (Post $post) use ($response) {
            $response->assertDontSee($post->title);
        });
    }

    /** @test */
    public function user_can_search_for_posts_by_tags()
    {
        $relevantTag = factory(Tag::class)->create();
        $relevantPosts = factory(Post::class, 3)->create(['status' => Post::STATUS_ACCEPTED])
            ->each(function (Post $post) use ($relevantTag) {
                $post->tags()->attach($relevantTag->id);
            });

        $irrelevantPosts = factory(Post::class, 3)->create(['status' => Post::STATUS_ACCEPTED]);


        $response = $this->get("/?tags[]={$relevantTag->id}");


        $response->assertSuccessful();
        $response->assertViewIs('web.posts.index');
        $response->assertSeeInOrder($relevantPosts->pluck('name')->toArray());
        $irrelevantPosts->each(function (Post $post) use ($response) {
            $response->assertDontSee($post->title);
        });
    }

    /** @test */
    public function user_can_combine_homepage_filters()
    {
        $relevantTags = factory(Tag::class, 2)->create();
        $relevantCategory = factory(Category::class)->create();
        $relevantPosts = factory(Post::class, 3)->create(['category_id' => $relevantCategory->id, 'status' => Post::STATUS_ACCEPTED])
            ->each(function (Post $post) use ($relevantTags) {
                $post->tags()->sync($relevantTags->pluck('id'));
            });

        $irrelevantPosts = collect([
            factory(Post::class)->create(['category_id' => $relevantCategory->id, 'status' => Post::STATUS_ACCEPTED]),
            factory(Post::class)->create(['status' => Post::STATUS_ACCEPTED]),
        ]);
        $irrelevantPosts->last()->tags()->sync($relevantTags->pluck('id'));

        $query = http_build_query([
            'category' => $relevantCategory->id,
            'tags' => $relevantTags->pluck('id')->toArray(),
        ]);


        $response = $this->get("/?{$query}");


        $response->assertSuccessful();
        $response->assertViewIs('web.posts.index');
        $response->assertSeeInOrder($relevantPosts->pluck('title')->toArray());
    }

    /** @test */
    public function user_can_visit_the_create_post_page()
    {
        $response = $this->get("/dodaj-objavu");


        $response->assertSuccessful();
        $response->assertViewIs('web.posts.create');
    }

    /** @test */
    public function user_can_create_a_post()
    {
        $data = $this->getPostData([
            'title' => 'Test Post',
            'description' => 'Test Description',
        ]);


        $response = $this->post("/dodaj-objavu", $data);


        $response->assertRedirect("/");
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post',
            'description' => 'Test Description',
        ]);
    }

    /** @test */
    public function new_tags_will_be_saved_when_creating_a_post()
    {
        $data = $this->getPostData([
            'tags' => 'test tag old new'
        ]);
        Tag::insert([
            ['name' => 'test'],
            ['name' => 'old'],
        ]);


        $response = $this->post("/dodaj-objavu", $data);


        $response->assertRedirect("/");
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('tags', [
            'name' => 'tag',
        ]);
        $this->assertDatabaseHas('tags', [
            'name' => 'new',
        ]);

        $post = Post::first();
        Tag::whereIn('name', ['test', 'tag', 'old', 'new'])->each(function (Tag $tag) use ($post) {
            $this->assertDatabaseHas('post_tag', [
                'post_id' => $post->id,
                'tag_id' => $tag->id,
            ]);
        });
    }

    /**
     * @test
     * @testWith ["title", null]
     *           ["description", null]
     *           ["link", null]
     *           ["category_id", null]
     *           ["category_id", 1]
     *           ["category_id", "not an integer"]
     *           ["tags", null]
     */
    public function user_cannot_create_a_post_using_invalid_data($field, $value)
    {
        $data = $this->getPostData([$field => $value]);


        $response = $this->from("/dodaj-objavu")->post("/dodaj-objavu", $data);


        $response->assertRedirect("/dodaj-objavu");
        $response->assertSessionHasErrors($field);
        $this->assertDatabaseMissing('posts', []);
        $this->assertDatabaseMissing('tags', []);
    }
}
