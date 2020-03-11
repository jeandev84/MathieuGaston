<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminSecurityController extends AbstractController
{
    /**
     * @Route("/register", name="inscription")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param UserPasswordEncoderInterface $encoder
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function register(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $form = $this->createForm(InscriptionType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $passwordCrypt = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($passwordCrypt);

            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('aliment.index');
        }

        return $this->render('admin_security/register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/login", name="connexion")
     * @param AuthenticationUtils $utils
     * @return \Symfony\Component\HttpFoundation\Response
    */
    public function login(AuthenticationUtils $utils)
    {
        return $this->render('admin_security/login.html.twig', [
            'lastUsername' => $utils->getLastUsername(),
            'error' => $utils->getLastAuthenticationError()
        ]);
    }


    /**
     * @Route("/logout", name="deconnexion")
     */
    public function logout()
    {

    }
}
