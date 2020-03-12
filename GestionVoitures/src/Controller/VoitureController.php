<?php
namespace App\Controller;


use App\Entity\Filter\RechercheVoiture;
use App\Form\RechercheVoitureType;
use App\Repository\VoitureRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class VoitureController
 * @package App\Controller
*/
class VoitureController extends AbstractController
{

    const LIMIT_PER_PAGE = 6;

    /**
     * @Route("/client/voitures", name="client.voiture.index")
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

        $rechercheVoiture = new RechercheVoiture();
        $form = $this->createForm(RechercheVoitureType::class, $rechercheVoiture);
        $form->handleRequest($request);

        // Get count of cars (voitures)
        /*
        $qb = $voitureRepository->createQueryBuilder('v');
        $count = $qb->select('count(v.id)')
                   ->getQuery()
                   ->getSingleScalarResult();
        dump($count); // 21
        */

        $voitures = $paginatorInterface->paginate(
            $voitureRepository->findAllWithPagination($rechercheVoiture),
            $request->query->getInt('page', 1),
            self::LIMIT_PER_PAGE
        );

        return $this->render('voiture/list.html.twig', [
            'voitures' => $voitures,
            'form' => $form->createView(),
            'admin' => false
        ]);
    }
}
