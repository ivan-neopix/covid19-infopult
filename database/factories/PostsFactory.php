<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});

$factory->define(Tag::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});

$factory->define(Post::class, function (Faker $faker, array $attributes) {
    if (!array_key_exists('category_id', $attributes)) {
        $attributes['category_id'] = factory(Category::class)->create()->id;
    }

    return [
        'title' => $faker->sentence,
        'description' => $faker->text,
        'link' => $faker->url,
        'category_id' => $attributes['category_id'],
    ];
});
