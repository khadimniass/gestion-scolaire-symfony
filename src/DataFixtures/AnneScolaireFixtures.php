<?php

namespace App\DataFixtures;

use App\Entity\AnneeScolaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AnneScolaireFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i=10;$i<20;$i++){
            $anneScolaire = new AnneeScolaire();
            $anneScolaire->setLibelle("20$i"."-20".$i+1);
            $manager->persist($anneScolaire);
        }
        $manager->flush();
    }
}
