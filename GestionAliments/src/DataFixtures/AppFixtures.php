<?php

namespace App\DataFixtures;

use App\Entity\Aliment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        # Carotte
        $a1 = new Aliment();
        $a1->setName('Carotte')
            ->setPrice(1.80)
            ->setCalorie(36)
            ->setImage('aliments/carotte.png')
            ->setProteine(0.77)
            ->setGlucide(6.45)
            ->setLipide(0.26);

        $manager->persist($a1);

        # Patate
        $a2 = new Aliment();
        $a2->setName('Patate')
            ->setPrice(1.5)
            ->setCalorie(80)
            ->setImage('aliments/patate.jpg')
            ->setProteine(1.8)
            ->setGlucide(16.7)
            ->setLipide(0.34);

        $manager->persist($a2);


        # Tomate
        $a3 = new Aliment();
        $a3->setName('Tomate')
            ->setPrice(2.3)
            ->setCalorie(18)
            ->setImage('aliments/tomate.png')
            ->setProteine(0.86)
            ->setGlucide(2.26)
            ->setLipide(0.24);

        $manager->persist($a3);


        # Pomme
        $a4 = new Aliment();
        $a4->setName('Pomme')
            ->setPrice(2.35)
            ->setCalorie(52)
            ->setImage('aliments/pomme.png')
            ->setProteine(0.25)
            ->setGlucide(11.6)
            ->setLipide(0.25);

        $manager->persist($a4);



        $manager->flush();
    }
}
