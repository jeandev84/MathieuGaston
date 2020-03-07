<?php
namespace App\Controller;

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
        $person1 = [
            'pseudo' => 'Marc',
            'age' => 25,
            'sexe' => true,
            'caract' => [
                'force' => 3,
                'agi' => 2,
                'intel' => 3
            ]
        ];

        $person2 = [
            'pseudo' => 'Milo',
            'age' => 30,
            'sexe' => true,
            'caract' => [
                'force' => 5,
                'agi' => 1,
                'intel' => 2
            ]
        ];


        $person3 = [
            'pseudo' => 'Tya',
            'age' => 22,
            'sexe' => true,
            'caract' => [
                'force' => 1,
                'agi' => 2,
                'intel' => 5
            ]
        ];
        return $this->render('personnage/list.html.twig', [

        ]);
    }
}
