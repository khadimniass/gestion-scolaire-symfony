<?php

namespace App\DataFixtures;

use App\Entity\Professeur;
use App\Entity\RP;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProfesseurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //il faut d'abor creer RP
        $faker = Factory::create("SN_sn");
        $rp = new RP();
        $rp->setNomComplet($faker->firstName()." ".$faker->lastName());
        $rp->setEmail($faker->email());
        $rp->setPassword($faker->password());
        $rp->setRoles(["ROLE_RP"]);
        $manager->persist($rp);
        for ($i=0;$i<=100;$i++) {
            $professeur = new Professeur();
            $professeur->setNomComplet($faker->firstName() . " " . $faker->lastName());
            $professeur->setGrade($faker->word);
            $professeur->setRp($rp);
            $manager->persist($professeur);
        }
        $manager->flush();
    }
}
