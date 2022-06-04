<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EtudiantFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       $faker = Factory::create();
       for ($i=0;$i<=100;$i++){
           $etudiant = new Etudiant();
           $etudiant->setNomComplet($faker->name());
           $etudiant->setEmail($faker->email());
           $etudiant->setPassword($faker->password(6));
           $etudiant->setSexe($i%3==0 ? "M":"F");
           $etudiant->setAdresse($faker->address());
           $etudiant->setMatricule($faker->words(8, true));
           $etudiant->setRoles(["ROLE_ETUDIANT"]);
           $manager->persist($etudiant);
       }
        $manager->flush();
    }
}
