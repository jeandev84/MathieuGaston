<?php

namespace App\Controller;

use App\Repository\AlimentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class AlimentController
 * @package App\Controller
 */
class AlimentController extends AbstractController
{
    /**
     * @Route("/", name="aliment.index")
     * @param AlimentRepository $alimentRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(AlimentRepository $alimentRepository)
    {
        return $this->render('aliment/index.html.twig', [
            'aliments' => $alimentRepository->findAll(),
            'isCalorie' => false,
            'isGlucide' => false
        ]);
    }


    /**
     * @Route("/aliments/calorie/{calorie}", name="aliment_by_calorie")
     * @param AlimentRepository $alimentRepository
     * @param $calorie
     * @return \Symfony\Component\HttpFoundation\Response
    */
    public function alimentMoinsCaloriques(AlimentRepository $alimentRepository, $calorie)
    {
        $aliments = $alimentRepository->getAlimentByProperty('calorie', '<', $calorie);

        return $this->render('aliment/index.html.twig', [
            'aliments' => $aliments,
            'isCalorie' => true,
            'isGlucide' => false
        ]);
    }


    /**
     * @Route("/aliments/glucide/{glucide}", name="aliment_by_glucide")
     * @param AlimentRepository $alimentRepository
     * @param $glucide
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function alimentMoinsGlucides(AlimentRepository $alimentRepository, $glucide)
    {
        $aliments = $alimentRepository->getAlimentByProperty('glucide', '<', $glucide);

        return $this->render('aliment/index.html.twig', [
            'aliments' => $aliments,
            'isCalorie' => false,
            'isGlucide' => true
        ]);
    }
}
