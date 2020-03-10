<?php

namespace App\Controller\Admin;

use App\Entity\Type;
use App\Form\TypeType;
use App\Repository\TypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class TypeController
 * @package App\Controller\Admin
 *
 * @Route("/admin/type", name="admin.type.")
 */
class TypeController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param TypeRepository $typeRepository
     * @return Response
     */
    public function index(TypeRepository $typeRepository)
    {
        return $this->render('admin/type/index.html.twig', [
            'types' => $typeRepository->findAll()
        ]);
    }


    /**
     * @Route("/new", name="create")
     * @Route("/{id}", name="edit", methods="GET|POST")
     * @param Type|null $type
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function addOrEdit(?Type $type, Request $request, EntityManagerInterface $em)
    {
        if(! $type)
        {
            $type = new Type();
        }

        $form = $this->createForm(TypeType::class, $type);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $modif = $type->getId() !== null;
            $em->persist($type);
            $em->flush();
            $this->addFlash('success', $modif ? "La modification a bien ete effectuee" : "L'ajout a bien ete effectuee");
            return $this->redirectToRoute('admin.type.index');
        }

        return $this->render('admin/type/form.html.twig', [
            'type' => $type,
            'form' => $form->createView(),
            'isModification' => $type->getId() !== null
        ]);
    }


    /**
     * @Route("/{id}", name="delete", methods="DELETE")
     * @param Type $type
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse
     */
    public function delete(Type $type, Request $request, EntityManagerInterface $em)
    {
        if($this->isCsrfTokenValid('delete'. $type->getId(), $request->get('_token')))
        {
            $em->remove($type);
            $em->flush();
            $this->addFlash('success', 'La suppression a bien ete effectuee');
            return $this->redirectToRoute('admin.type.index');
        }
    }
}
