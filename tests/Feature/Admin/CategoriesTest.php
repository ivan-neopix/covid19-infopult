<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\AdminDomain;
use Tests\Traits\AuthenticatedAdmin;

class CategoriesTest extends TestCase
{
    use RefreshDatabase, AdminDomain, AuthenticatedAdmin;

    /** @test */
    public function admin_can_visit_the_categories_index()
    {
        $categories = collect([
            factory(Category::class)->create(['name' => 'Kursevi']),
            factory(Category::class)->create(['name' => 'Medicinska oprema']),
            factory(Category::class)->create(['name' => 'Saveti']),
        ]);


        $response = $this->get("/categories");


        $response->assertSuccessful();
        $response->assertViewIs('admin.categories.index');
        $response->assertSeeInOrder($categories->pluck('name')->toArray());
    }

    /** @test */
    public function categories_index_will_be_paginated()
    {
        $catgories = factory(Category::class, 15)->create()->sortBy('name');


        $response = $this->get("/categories?page=2");


        $response->assertSuccessful();
        $response->assertViewIs('admin.categories.index');
        $response->assertSeeInOrder($catgories->splice(10)->pluck('name')->toArray());
    }
}
