<?php
namespace App\Controller;

use App\Entity\Personnage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class PersonnageController
 * @package App\Controller
*/
class PersonnageController extends AbstractController
{
    /**
     * @Route("/", name="acceuil")
    */
    public function index()
    {
        return $this->render('personnage/index.html.twig', [
            'controller_name' => 'PersonnageController',
        ]);
    }


    /**
     * @Route("/persons", name="personnages")
    */
    public function persons()
    {

        Personnage::creerPersonnage();

        return $this->render('personnage/list.html.twig', [
          'players' => Personnage::$personnages
        ]);
    }

    /**
     * @Route("/persons/{nom}", name="afficher_personnage")
     */
    public function afficherPersonnage($nom)
    {
        Personnage::creerPersonnage();

        $perso = Personnage::getPersonnageParNom($nom);

        return $this->render('personnage/show.html.twig', [
            'perso' => $perso,
            'nom' => $nom
        ]);
    }
}
