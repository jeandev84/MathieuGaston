<?php

namespace App\Controller;

use App\Entity\Filter\RechercheVoiture;
use App\Entity\Voiture;
use App\Form\RechercheVoitureType;
use App\Form\VoitureType;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController
 * @package App\Controller
*/
class AdminController extends AbstractController
{

    const LIMIT_PER_PAGE = 6;

    /**
     * @Route("/admin", name="admin.voiture.index")
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
            'admin' => true
        ]);
    }


    /**
     * @Route("/admin/new", name="admin.voiture.create")
     * @Route("/admin/{id}", name="admin.voiture.edit", methods="GET|POST")
     * @param Voiture|null $voiture
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function edit(?Voiture $voiture, Request $request, EntityManagerInterface $em)
    {
        if(! $voiture)
        {
            $voiture = new Voiture();
        }

        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($voiture);
            $em->flush();
            $this->addFlash('success', "L'action a bien ete effectue");
            return $this->redirectToRoute('admin.voiture.index');
        }

        return $this->render('admin/edit.html.twig', [
            'voiture' => $voiture,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/admin/{id}", name="admin.voiture.delete", methods="DELETE")
     * @param Voiture|null $voiture
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
    */
    public function delete(Voiture $voiture, Request $request, EntityManagerInterface $em)
    {
        if($this->isCsrfTokenValid('delete'. $voiture->getId(), $request->get('_token')))
        {
            $em->remove($voiture);
            $em->flush();
            $this->addFlash('success', "L'action a bien ete effectue");
            return $this->redirectToRoute('admin.voiture.index');
        }
    }
}
