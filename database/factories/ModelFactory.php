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
        'password' => 'secret',
        'role' => 'user',
        'remember_token' => str_random(10),
    ];
});

$factory->defineAs(App\User::class, 'teacher', function (Faker\Generator $faker) use ($factory) {
    $user = $factory->raw(App\User::class);

    return array_merge($user, ['role' => 'teacher']);
});

$factory->defineAs(App\User::class, 'admin', function (Faker\Generator $faker) use ($factory) {
    $user = $factory->raw(App\User::class);

    return array_merge($user, ['role' => 'admin']);
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
        'course_id' => function () {
            return factory(App\Course::class)->create()->id;
        },
    ];
});

$factory->define(App\Question::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraphs(mt_rand(1, 3), true),
        'course_id' => function () {
            return factory(App\Course::class)->create()->id;
        },
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
    ];
});

$factory->define(App\Answer::class, function (Faker\Generator $faker) {
    return [
        'body' => $faker->paragraphs(mt_rand(1, 3), true),
        'question_id' => function () {
            return factory(App\Question::class)->create()->id;
        },
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
    ];
});
