<?php

namespace App\DataFixtures;

use App\Entity\Module;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ModuleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i=0;$i<25;$i++){
            $model = new Module();
            $model->setLibelleModule($faker->word);
            $manager->persist($model);
        }
        $manager->flush();
    }
}
