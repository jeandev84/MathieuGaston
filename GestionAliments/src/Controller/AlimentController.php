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
        ]);
    }
}
