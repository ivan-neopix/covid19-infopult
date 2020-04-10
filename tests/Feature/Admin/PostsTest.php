<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\Post;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\AdminDomain;
use Tests\Traits\AuthenticatedAdmin;

class PostsTest extends TestCase
{
    use RefreshDatabase, AdminDomain, AuthenticatedAdmin;

    /** @test */
    public function admins_can_visit_the_posts_index_page()
    {
        $posts = collect([
            factory(Post::class)->create(['created_at' => CarbonImmutable::create(2019, 4, 4, 20, 30)]),
            factory(Post::class)->create(['created_at' => CarbonImmutable::create(2019, 4, 4, 19, 30)]),
            factory(Post::class)->create(['created_at' => CarbonImmutable::create(2019, 4, 4, 18, 30)]),
            factory(Post::class)->create(['created_at' => CarbonImmutable::create(2019, 4, 4, 17, 30)]),
        ]);


        $response = $this->get("/posts");


        $response->assertSuccessful();
        $response->assertViewIs('admin.posts.index');
        $response->assertSeeInOrder($posts->pluck('title')->toArray());
        $response->assertSeeInOrder($posts->pluck('description')->toArray());
    }

    /** @test */
    public function posts_index_page_will_be_paginated()
    {
        $posts = factory(Post::class, 18)->create();


        $response = $this->get("/posts?page=2");


        $response->assertSuccessful();
        $response->assertViewIs('admin.posts.index');
        $response->assertSeeInOrder($posts->slice(10)->pluck('title')->toArray());
    }

    /** @test */
    public function admins_can_search_for_posts_by_title()
    {
        $relevantPosts = collect([
            factory(Post::class)->create(['title' => 'Test Post 1']),
            factory(Post::class)->create(['title' => 'Test Post 2']),
            factory(Post::class)->create(['title' => 'Test Post 3']),
        ]);
        $irrelevantPosts = collect([
            factory(Post::class)->create(['title' => 'Irrelevant Post 1']),
            factory(Post::class)->create(['title' => 'Irrelevant Post 2']),
            factory(Post::class)->create(['title' => 'Irrelevant Post 3']),
        ]);


        $response = $this->get("/posts?search=test");


        $response->assertSuccessful();
        $response->assertViewIs('admin.posts.index');
        $response->assertSeeInOrder($relevantPosts->pluck('title')->toArray());
        $irrelevantPosts->each(function (Post $post) use ($response) {
            $response->assertDontSee($post->title);
        });
    }

    /** @test */
    public function admin_can_accept_posts()
    {
        $post = factory(Post::class)->create(['status' => Post::STATUS_PENDING]);


        $response = $this->from("/posts?page=7")->patch("/posts/{$post->id}/approve");


        $response->assertRedirect("/posts?page=7");
        $response->assertSessionHas('success');
        $this->assertEquals(Post::STATUS_ACCEPTED, $post->refresh()->status);
    }

    /** @test */
    public function admin_can_decline_posts()
    {
        $post = factory(Post::class)->create(['status' => Post::STATUS_PENDING]);


        $response = $this->from("/posts?page=2?search=test")->delete("/posts/{$post->id}/deny");


        $response->assertRedirect("/posts?page=2?search=test");
        $response->assertSessionHas('success');
        $this->assertEquals(Post::STATUS_DECLINED, $post->refresh()->status);
    }

    /** @test */
    public function admin_can_visit_the_edit_post_page()
    {
        $post = factory(Post::class)->create([
            'status' => Post::STATUS_PENDING,
        ]);


        $response = $this->get("/posts/{$post->id}/edit");


        $response->assertSuccessful();
        $response->assertViewIs('admin.posts.edit');
        $response->assertSee($post->title);
        $response->assertSee($post->description);
        $response->assertSee($post->link);
    }

    public function nonPendingStatuses()
    {
        return [
            ['accepted'],
            ['declined'],
        ];
    }

    /**
     * @test
     * @dataProvider nonPendingStatuses
     */
    public function admin_cannot_visit_the_edit_post_page_for_non_pending_tags($status)
    {
        $post = factory(Post::class)->create([
            'status' => $status,
        ]);


        $response = $this->get("/posts/{$post->id}/edit");


        $response->assertRedirect("/de-si-poso/posts");
        $response->assertSessionHas('error');
    }

    /** @test */
    public function admin_can_update_posts()
    {
        $oldCategory = factory(Category::class)->create();
        $newCategory = factory(Category::class)->create();
        $post = factory(Post::class)->create([
            'category_id' => $oldCategory->id,
        ]);


        $response = $this->patch("/posts/{$post->id}", [
            'category_id' => $newCategory->id,
            'tags' => 'test1 test2 test3'
        ]);


        $response->assertRedirect("/de-si-poso/posts");
        $response->assertSessionHas('success');
        $this->assertEquals($newCategory->id, $post->refresh()->category_id);
        $this->assertEquals($post->tags->pluck('name')->implode(' '), 'test1 test2 test3');
    }

    /**
     * @test
     * @dataProvider nonPendingStatuses
     */
    public function admin_cannot_update_non_pending_posts($status)
    {
        $category = factory(Category::class)->create();
        $post = factory(Post::class)->create([
            'status' => $status,
            'category_id' => $category->id,
        ]);


        $response = $this->patch("/posts/{$post->id}", [
            'category_id' => factory(Category::class)->create()->id,
            'tags' => 'test1 test2',
        ]);


        $response->assertRedirect("/de-si-poso/posts");
        $response->assertSessionHas('error');
        $this->assertEquals($category->id, $post->refresh()->category_id);
    }
}
