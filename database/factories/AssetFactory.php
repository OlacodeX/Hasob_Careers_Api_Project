<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        //
        'type' => $this->faker->text(10),
        'serialNumber' => $this->faker->number(10),
        'description' => $this->faker->text(50),
        'fixed_movable' => $this->faker->text(3),
        'picture_path' => $this->faker->text(10),
        'purchase_date' => $this->faker->text(10),
        'start_use_date' => $this->faker->text(10),
        'purchase_price' => $this->faker->number(10),
        'warranty_expiry_date' => $this->faker->text(10),
        'degradation_in_yeard' => $this->faker->number(10),
        'current_value_in_naira' => $this->faker->number(10),
        'location' => $this->faker->text(10),
        
    ];
});
