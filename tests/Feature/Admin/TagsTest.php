<?php

namespace Tests\Feature\Admin;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\AdminDomain;
use Tests\Traits\AuthenticatedAdmin;

class TagsTest extends TestCase
{
    use RefreshDatabase, AdminDomain, AuthenticatedAdmin;

    /** @test */
    public function admin_can_visit_the_tags_index_page()
    {
        $tags = collect([
            factory(Tag::class)->create(['name' => 'assistance']),
            factory(Tag::class)->create(['name' => 'bread']),
            factory(Tag::class)->create(['name' => 'cheap']),
            factory(Tag::class)->create(['name' => 'delivery']),
        ]);


        $response = $this->get("/tags");


        $response->assertSuccessful();
        $response->assertViewIs('admin.tags.index');
        $response->assertSeeInOrder($tags->pluck('name')->toArray());
    }

    /** @test */
    public function tags_index_page_will_be_paginated()
    {
        $tags = factory(Tag::class, 80)->create()->sortBy('name');


        $response = $this->get("/tags?page=2");


        $response->assertViewIs('admin.tags.index');
        $response->assertSeeInOrder($tags->slice(50)->pluck('name')->toArray());
    }

    /** @test */
    public function admin_can_search_for_tags()
    {
        $relevantTags = collect([
            factory(Tag::class)->create(['name' => 'volunteers_assistance']),
            factory(Tag::class)->create(['name' => 'volunteers_belgrade']),
            factory(Tag::class)->create(['name' => 'volunteers_help']),
        ]);
        $irrelevantTags = collect([
            factory(Tag::class)->create(['name' => 'food']),
            factory(Tag::class)->create(['name' => 'vegetables']),
            factory(Tag::class)->create(['name' => 'bread']),
        ]);


        $response = $this->get("/tags?search=volunteers");


        $response->assertSuccessful();
        $response->assertViewIs('admin.tags.index');
        $response->assertSeeInOrder($relevantTags->pluck('name')->toArray());
        $irrelevantTags->each(function (Tag $tag) use ($response) {
            $response->assertDontSee($tag->name);
        });

    }

    /** @test */
    public function admin_can_create_tags()
    {
        $data = ['name' => 'voluntary_services'];


        $response = $this->post("/tags", $data);


        $response->assertRedirect("/tags");
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('tags', [
            'name' => 'voluntary_services',
        ]);
    }

    /**
     * @test
     * @testWith [null]
     *           ["I am an invalid tag"]
     */
    public function admin_cannot_create_invalid_tags($tagName)
    {
        $data = ['name' => $tagName];


        $response = $this->from("/tags/create")->post("/tags", $data);


        $response->assertRedirect("/tags/create");
        $response->assertSessionHasErrors('name');
        $this->assertDatabaseMissing('tags', [
            'name' => $tagName,
        ]);
    }

    /** @test */
    public function admin_can_access_the_view_tag_page()
    {
        $tag = factory(Tag::class)->create();
        $posts = factory(Post::class, 20)->create();
        $tag->posts()->sync($posts->pluck('id'));


        $response = $this->get("/tags/{$tag->id}");


        $response->assertSuccessful();
        $response->assertViewIs('admin.tags.show');
        $response->assertSee($tag->name);
        $response->assertSeeInOrder($posts->take(10)->pluck('id')->toArray());
        $this->assertEquals(20, $response->viewData('postsCount'));
    }
}
