<?php

namespace App\DataFixtures;

use App\Entity\Aliment;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        # creer 2 types
        $t1 = new Type();
        $t1->setLibelle('Fruits')
           ->setImage('fruits.jpg');

        $manager->persist($t1);

        $t2 = new Type();
        $t2->setLibelle('Legumes')
            ->setImage('legumes.jpg');

        $manager->persist($t2);

        # get aliment repository
        $alimentRepository = $manager->getRepository(Aliment::class);

        # add type or category
        $a1 = $alimentRepository->findOneBy(['name' => 'Patate']);
        $a1->setType($t2);
        $manager->persist($a1);

        $a2 = $alimentRepository->findOneBy(['name' => 'Tomate']);
        $a2->setType($t2);
        $manager->persist($a2);

        $a3 = $alimentRepository->findOneBy(['name' => 'Pomme']);
        $a3->setType($t1);
        $manager->persist($a3);


        # sauvegarde dans la base de donnees
        $manager->flush();
    }
}
