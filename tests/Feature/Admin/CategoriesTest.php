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

    /** @test */
    public function admin_can_visit_the_edit_category_page()
    {
        $category = factory(Category::class)->create();


        $response = $this->get("/categories/{$category->id}/edit");


        $response->assertSuccessful();
        $response->assertViewIs('admin.categories.edit');
        $this->assertTrue($category->is($response->viewData('category')));
    }

    /** @test */
    public function admin_can_update_a_category()
    {
        $category = factory(Category::class)->create([
            'name' => 'Old Category Name',
         ]);


        $response = $this->put("/categories/{$category->id}", [
            'name' => 'New Category Name',
        ]);


        $response->assertRedirect("/categories");
        $response->assertSessionHas('success');
        $this->assertEquals('New Category Name', $category->refresh()->name);
    }

    /** @test */
    public function admin_cannot_update_a_category_using_invalid_data()
    {
        $category = factory(Category::class)->create([
            'name' => 'Old Category Name',
        ]);


        $response = $this->from("/categories/{$category->id}/edit")->put("/categories/{$category->id}");


        $response->assertRedirect("/categories/{$category->id}/edit");
        $response->assertSessionHasErrors('name');
        $this->assertEquals('Old Category Name', $category->refresh()->name);
    }

    /** @test */
    public function admin_can_visit_the_create_category_page()
    {
        $response = $this->get("/categories/create");


        $response->assertSuccessful();
        $response->assertViewIs('admin.categories.create');
    }

    /** @test */
    public function admin_can_create_a_category()
    {
        $data = ['name' => 'New Category'];


        $response = $this->post("/categories", $data);


        $response->assertRedirect("/categories");
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('categories', [
            'name' => 'New Category',
        ]);
    }

    /** @test */
    public function admin_cannot_create_a_category_without_specifying_a_name_for_it()
    {
        $data = ['name' => null];


        $response = $this->from("/categories/create")->post("/categories", $data);


        $response->assertRedirect("/categories/create");
        $response->assertSessionHasErrors('name');
        $this->assertDatabaseMissing('categories', []);
    }

    /** @test */
    public function admin_can_delete_category()
    {
        $category = factory(Category::class)->create();


        $response = $this->delete("/categories/{$category->id}");


        $response->assertRedirect("/categories");
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
    }
}
