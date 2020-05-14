<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Firewall_model::class, function (Faker\Generator $faker) {
    return [
        'allowdownloadsignedenabled' => $faker->boolean,
        'allowsignedenabled' => $faker->boolean,
        'applications' => json_encode(['com.cisco.Jabber' => 1, 'com.apple.garageband10' => 1]),
        'firewallunload' => $faker->boolean,
        'globalstate' => $faker->boolean,
        'loggingenabled' => $faker->boolean,
        'loggingoption' => $faker->randomNumber,
        'services' => json_encode(['File Sharing (SMB)' => 1, 'Remote Login - SSH' => 1]),
        'stealthenabled' => $faker->boolean,
        'version' => $faker->randomDigit . '.' . $faker->randomDigit . "." . $faker->randomDigit,
    ];
});