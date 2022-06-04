<?php

namespace App\DataFixtures;

use App\Entity\Demande;
use App\Entity\Etudiant;
use App\Entity\RP;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class DemandeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $etudiant = new Etudiant();
        $etudiant->setNomComplet($faker->name());
        $etudiant->setEmail($faker->email());
        $etudiant->setPassword($faker->password(6));
        $etudiant->setSexe("F");
        $etudiant->setAdresse($faker->address());
        $etudiant->setMatricule($faker->word);
        $etudiant->setRoles(["ROLE_ETUDIANT"]);
        $manager->persist($etudiant);
        $rp = new RP();
        $rp->setRoles(["ROLE_RP"]);
        $rp->setNomComplet($faker->name("male"));
        $rp->setEmail($faker->email());
        $rp->setPassword($faker->password(6));
        $manager->persist($rp);
        for ($i=0;$i<150;$i++){
            $demande = new Demande();
            $demande->setMotif($faker->sentence(6));
          //  $demande->setCreatedAt($faker->dateTime());
            $demande->setEtudiant($etudiant);
            $demande->setRP($rp);
          $manager->persist($demande);
        }
        $manager->flush();
    }
}
