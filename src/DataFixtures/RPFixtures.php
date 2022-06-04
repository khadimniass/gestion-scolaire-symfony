<?php

namespace App\DataFixtures;

use App\Entity\RP;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class RPFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("SN_sn");
        for ($i=1;$i<=10;$i++){
            $rp=new RP();
            $rp->setNomComplet($faker->firstName()." ".$faker->lastName());
            $rp->setEmail($faker->email());
            $rp->setRoles(["ROLE_RP"]);
            $rp->setPassword($faker->password());
            $manager->persist($rp);
        }
        $manager->flush();
    }
}
