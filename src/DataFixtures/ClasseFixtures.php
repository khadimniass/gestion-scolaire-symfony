<?php

namespace App\DataFixtures;

use App\Entity\Classe;
use App\Entity\RP;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClasseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $rp = new RP();
        $rp->setNomComplet("Mame Rawane");
        $rp->setEmail("rawane@gmail.com");
        $rp->setPassword("passer");
        $rp->setRoles(["ROLE_RP"]);
        $manager->persist($rp);
        for ($i=1;$i<4;$i++){
            $classe = new Classe();
            $classe->setLibelle("classe $i");
            $classe->setNiveau("licence $i");
            $classe->setRp($rp);
            $manager->persist($classe);
            $manager->flush();
        }
    }
}
