<?php

namespace App\Controller;

use App\Repository\VoitureRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoitureController extends AbstractController
{

    const LIMIT_PER_PAGE = 6;

    /**
     * @Route("/client/voitures", name="voitures")
     * @param VoitureRepository $voitureRepository
     * @param PaginatorInterface $paginatorInterface
     * @param Request $request
     * @return Response
     */
    public function index(
    VoitureRepository $voitureRepository,
    PaginatorInterface $paginatorInterface,
    Request $request)
    {

        $voitures = $paginatorInterface->paginate(
            $voitureRepository->findAllWithPagination(),
            $request->query->getInt('page', 1),
            self::LIMIT_PER_PAGE
        );

        return $this->render('voiture/list.html.twig', [
            'voitures' => $voitures
        ]);
    }
}
