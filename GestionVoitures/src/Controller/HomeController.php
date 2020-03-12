<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class HomeController
 * @package App\Controller
*/
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
    */
    public function index()
    {
        return $this->render('home/index.html.twig');
    }


    /**
     * @Route("/inscription", name="inscription")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     */
    public function register(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder)
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(InscriptionType::class, $utilisateur);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
             $passwordCrypte = $encoder->encodePassword($utilisateur, $utilisateur->getPassword());
             $utilisateur->setPassword($passwordCrypte);
             $utilisateur->setRoles('ROLE_USER');
             $em->persist($utilisateur);
             $em->flush();
             return $this->redirectToRoute('accueil');
        }

        return $this->render('home/register.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/login", name="login")
     * @param AuthenticationUtils $utils
     * @return Response
     */
    public function login(AuthenticationUtils $utils)
    {
        return $this->render('home/login.html.twig', [
            'lastUsername' => $utils->getLastUsername(),
            'error' => $utils->getLastAuthenticationError()
        ]);
    }


    /**
     * @Route("/logout", name="logout")
    */
    public function logout() {}
}
