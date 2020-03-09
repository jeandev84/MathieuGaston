<?php

namespace App\Controller\Admin;

use App\Entity\Aliment;
use App\Form\AlimentType;
use App\Repository\AlimentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class AdminAlimentController
 * @package App\Controller\Admin
 *
 * @Route("/admin/aliments", name="admin.aliment.")
*/
class AdminAlimentController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param AlimentRepository $alimentRepository
     * @return Response
     */
    public function list(AlimentRepository $alimentRepository)
    {
        return $this->render('admin/admin_aliment/index.html.twig', [
            'aliments' => $alimentRepository->findAll()
        ]);
    }


    /**
     * @Route("/new", name="create")
     * @Route("/{id}", name="edit", methods="GET|POST")
     * @param Aliment $aliment
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function addOrEdit(?Aliment $aliment, Request $request, EntityManagerInterface $em)
    {
        if(! $aliment)
        {
            $aliment = new Aliment();
        }

        $form = $this->createForm(AlimentType::class, $aliment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $modif = $aliment->getId() !== null;
            $em->persist($aliment);
            $em->flush();
            $this->addFlash('success', $modif ? "La modification a bien ete effectuee" : "L'ajout a bien ete effectuee");
            return $this->redirectToRoute('admin.aliment.index');
        }

        return $this->render('admin/admin_aliment/form.html.twig', [
            'aliment' => $aliment,
            'form' => $form->createView(),
            'isModification' => $aliment->getId() !== null
        ]);
    }


    /**
     * @Route("/{id}", name="delete", methods="DELETE")
     * @param Aliment $aliment
     * @param Request $request
     * @return Response
     */
    public function delete(Aliment $aliment, Request $request, EntityManagerInterface $em)
    {
        if($this->isCsrfTokenValid('delete'. $aliment->getId(), $request->get('_token')))
        {
            $em->remove($aliment);
            $em->flush();
            $this->addFlash('success', 'La suppression a bien ete effectuee');
            return $this->redirectToRoute('admin.aliment.index');
        }
    }

}
