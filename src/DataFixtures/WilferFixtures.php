<?php

namespace App\DataFixtures;

use App\Entity\Wilfer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class WilferFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for($i = 0; $i < 20; $i ++){
            $wilfer = new Wilfer();
            $wilfer->setFirstname($faker->firstName);
            $wilfer->setLastname($faker->lastName);
            $wilfer->setFullName($faker->name);
            $wilfer->setBirthAt($faker->dateTime);
            $wilfer->setDescription($faker->realText(100));
            $manager->persist($wilfer);
        }

        $manager->flush();
    }
}
