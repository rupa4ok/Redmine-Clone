<?php

use Faker\Generator as Faker;

$factory->define(\App\Task::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'status_id' => function () {
            return factory(App\TaskStatus::class)->create()->id;
        },
        'creator_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'executor_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});
