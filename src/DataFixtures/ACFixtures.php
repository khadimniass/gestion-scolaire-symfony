<?php

namespace App\DataFixtures;

use App\Entity\AC;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ACFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i=0;$i<=100;$i++){
            $ac = new AC();
            $ac->setNomComplet($faker->name());
            $ac->setEmail($faker->email());
            $ac->setPassword($faker->password(8));
            $manager->persist($ac);
        }

        $manager->flush();
    }
}
