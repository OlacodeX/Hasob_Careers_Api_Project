<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Assignment;
use Faker\Generator as Faker;

$factory->define(Assignment::class, function (Faker $faker) {
    return [
        //      
                'asset_id' => '3',
                'assignment_date' => '2022-11-22',
                'status' => 'Ok',
                'is_due' => 'Yes',
                'due_date' => '2022-12-21',
                'assigned_user_id' => '1',
                'assigned_by' =>'2'
        
    ];
});
