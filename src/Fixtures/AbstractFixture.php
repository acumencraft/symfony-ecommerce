<?php

namespace App\Fixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;
use Faker\Generator;

abstract class AbstractFixture extends Fixture
{
    protected Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }
}
