<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'role' => $faker->randomElement(['professor', 'student']),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Course::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence,
    ];
});

$factory->define(App\Content::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraphs(mt_rand(1, 5), true),
    ];
});
