<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Asset;
use Faker\Generator as Faker;

$factory->define(Asset::class, function (Faker $faker) {
    return [
        //
        'type' => 'New',
        'serialNumber' => $faker->phoneNumber,
        'description' => $faker->sentence,
        'fixed_movable' => 'Yes',
        'picture_path' => 'https://source.unsplash.com/random',
        'purchase_date' => $faker->dateTimeBetween('1990-01-01', '2012-12-31')->format('d/m/Y'),
        'start_use_date' => $faker->dateTimeBetween('1990-01-01', '2012-12-31')->format('d/m/Y'),
        'purchase_price' => '1500',
        'warranty_expiry_date' => $faker->dateTimeBetween('1990-01-01', '2012-12-31')->format('d/m/Y'),
        'degradation_in_yeard' => $faker->dateTimeBetween('1990-01-01', '2012-12-31')->format('Y'),
        'current_value_in_naira' => '2000',
        'location' => 'Nigeria',
        
    ];
});
