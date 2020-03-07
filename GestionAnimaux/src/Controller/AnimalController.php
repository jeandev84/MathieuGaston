<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class AnimalController
 * @package App\Controller
*/
class AnimalController extends AbstractController
{
    /**
     * @Route("/", name="animal.index")
     * @param AnimalRepository $animalRepository
     * @return \Symfony\Component\HttpFoundation\Response
    */
    public function index(AnimalRepository $animalRepository)
    {
        return $this->render('animal/index.html.twig', [
            'animals' => $animalRepository->findAll()
        ]);
    }


    /**
     * @Route("/animal/{id}", name="animal.show")
     * @param Animal $animal
     * @return \Symfony\Component\HttpFoundation\Response
    */
    public function show(Animal $animal)
    {
        return $this->render('animal/show.html.twig', [
            'animal' => $animal
        ]);
    }
}
