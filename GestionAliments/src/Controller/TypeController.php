<?php

namespace App\Controller;

use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TypeController extends AbstractController
{
    /**
     * @Route("/types", name="type.index")
     * @param TypeRepository $typeRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(TypeRepository $typeRepository)
    {
        return $this->render('type/index.html.twig', [
            'types' => $typeRepository->findAll()
        ]);
    }
}
