<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AnimalFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 5 animals
        $a1 = new Animal();
        $a1->setName('Chien')
           ->setDescription('Un animal domestique')
           ->setImage('chien.png')
           ->setWeight(10)
           ->setDangerous(false)
        ;

        $manager->persist($a1);

        $a2 = new Animal();
        $a2->setName('Cochon')
            ->setDescription("Un animal d'elevage")
            ->setImage('cochon.png')
            ->setWeight(300)
            ->setDangerous(false)
        ;
        $manager->persist($a2);

        $a3 = new Animal();
        $a3->setName('Serpent')
            ->setDescription('Un animal dangereux')
            ->setImage('serpent.png')
            ->setWeight(5)
            ->setDangerous(true)
        ;
        $manager->persist($a3);

        $a4 = new Animal();
        $a4->setName('Crocodile')
            ->setDescription('Un animal tres dangereux')
            ->setImage('croco.png')
            ->setWeight(500)
            ->setDangerous(true)
        ;
        $manager->persist($a4);


        $a5 = new Animal();
        $a5->setName('Requin')
            ->setDescription('Un animal marin tres dangereux')
            ->setImage('requin.png')
            ->setWeight(800)
            ->setDangerous(true)
        ;
        $manager->persist($a5);

        // save changes to the database
        $manager->flush();
    }
}
