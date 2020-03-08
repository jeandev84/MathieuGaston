<?php

namespace App\Controller;

use App\Entity\Continent;
use App\Repository\ContinentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ContinentController
 * @package App\Controller
*/
class ContinentController extends AbstractController
{
    /**
     * @Route("/continents", name="continent.index")
     * @param ContinentRepository $continentRepository
     * @return \Symfony\Component\HttpFoundation\Response
    */
    public function index(ContinentRepository $continentRepository)
    {
        return $this->render('continent/index.html.twig', [
            'continents' => $continentRepository->findAll()
        ]);
    }


    /**
     * @Route("/continent/{id}", name="continent.show")
     * @param Continent $continent
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Continent $continent) # parameter convertor
    {
        return $this->render('continent/show.html.twig', [
            'continent' => $continent
        ]);
    }
}
