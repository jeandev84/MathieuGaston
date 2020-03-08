<?php
namespace App\Controller;

use App\Entity\Familly;
use App\Repository\FamillyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class FamillyController
 * @package App\Controller
*/
class FamillyController extends AbstractController
{

    /**
     * @Route("/famillies", name="familly.index")
     * @param FamillyRepository $famillyRepository
     * @return \Symfony\Component\HttpFoundation\Response
    */
    public function index(FamillyRepository $famillyRepository)
    {
        return $this->render('familly/index.html.twig', [
            'famillies' => $famillyRepository->findAll()
        ]);
    }


    /**
     * @Route("/familly/{id}", name="familly.show")
     * @param Familly $familly
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Familly $familly)
    {
        return $this->render('familly/show.html.twig', [
            'familly' => $familly
        ]);
    }
}
