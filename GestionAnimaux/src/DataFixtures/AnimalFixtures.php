<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use App\Entity\Continent;
use App\Entity\Dispose;
use App\Entity\Familly;
use App\Entity\Person;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AnimalFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 3 personnes
        $p1 = new Person();
        $p1->setName('Milo');
        $manager->persist($p1);

        $p2 = new Person();
        $p2->setName('Tya');
        $manager->persist($p2);

        $p3 = new Person();
        $p3->setName('Lili');
        $manager->persist($p3);


        // create 5 continents
        $continent1 = new Continent();
        $continent1->setLibelle('Europe');
        $manager->persist($continent1);

        $continent2 = new Continent();
        $continent2->setLibelle('Asie');
        $manager->persist($continent2);

        $continent3 = new Continent();
        $continent3->setLibelle('Afrique');
        $manager->persist($continent3);

        $continent4 = new Continent();
        $continent4->setLibelle('Oceanie');
        $manager->persist($continent4);

        $continent5 = new Continent();
        $continent5->setLibelle('Amerique');
        $manager->persist($continent5);


        // create 3 famillies
        $f1 = new Familly();
        $f1->setLibelle('mammiferes')
           ->setDescription('Animaux vertebres nourrissant leurs petits avec du lait');
        $manager->persist($f1);

        $f2 = new Familly();
        $f2->setLibelle('reptiles')
            ->setDescription('Animaux vertebres qui rempent');
        $manager->persist($f2);

        $f3 = new Familly();
        $f3->setLibelle('poissons')
            ->setDescription('Animaux invertebres du monde aquatique');
        $manager->persist($f3);

        // create 5 animals
        $a1 = new Animal();
        $a1->setName('Chien')
           ->setDescription('Un animal domestique')
           ->setImage('chien.png')
           ->setWeight(10)
           ->setDangerous(false)
           ->setFamilly($f1)
           ->addContinent($continent1)
           ->addContinent($continent2)
           ->addContinent($continent3)
           ->addContinent($continent4)
           ->addContinent($continent5)
        ;

        $manager->persist($a1);

        $a2 = new Animal();
        $a2->setName('Cochon')
            ->setDescription("Un animal d'elevage")
            ->setImage('cochon.png')
            ->setWeight(300)
            ->setDangerous(false)
            ->setFamilly($f1)
            ->addContinent($continent1)
            ->addContinent($continent5)
        ;
        $manager->persist($a2);

        $a3 = new Animal();
        $a3->setName('Serpent')
            ->setDescription('Un animal dangereux')
            ->setImage('serpent.png')
            ->setWeight(5)
            ->setDangerous(true)
            ->setFamilly($f2)
            ->addContinent($continent2)
            ->addContinent($continent3)
            ->addContinent($continent4)
        ;
        $manager->persist($a3);

        $a4 = new Animal();
        $a4->setName('Crocodile')
            ->setDescription('Un animal tres dangereux')
            ->setImage('croco.png')
            ->setWeight(500)
            ->setDangerous(true)
            ->setFamilly($f2)
            ->addContinent($continent3)
            ->addContinent($continent4)
        ;
        $manager->persist($a4);


        $a5 = new Animal();
        $a5->setName('Requin')
            ->setDescription('Un animal marin tres dangereux')
            ->setImage('requin.png')
            ->setWeight(800)
            ->setDangerous(true)
            ->setFamilly($f3)
            ->addContinent($continent4)
            ->addContinent($continent5)
        ;
        $manager->persist($a5);

        // table de liens
        $d1 = new Dispose();
        $d1->setPersonnes($p1)
           ->setAnimal($a1)
           ->setNb(30)
        ;

        $manager->persist($d1);

        $d2 = new Dispose();
        $d2->setPersonnes($p1)
            ->setAnimal($a2)
            ->setNb(10)
        ;

        $manager->persist($d2);


        $d3 = new Dispose();
        $d3->setPersonnes($p1)
            ->setAnimal($a3)
            ->setNb(10)
        ;

        $manager->persist($d3);


        $d4 = new Dispose();
        $d4->setPersonnes($p2)
            ->setAnimal($a3)
            ->setNb(5)
        ;

        $manager->persist($d4);


        $d5 = new Dispose();
        $d5->setPersonnes($p2)
            ->setAnimal($a4)
            ->setNb(10)
        ;

        $manager->persist($d5);

        $d6 = new Dispose();
        $d6->setPersonnes($p3)
            ->setAnimal($a5)
            ->setNb(20)
        ;

        $manager->persist($d6);


        // save changes to the database
        $manager->flush();
    }
}
