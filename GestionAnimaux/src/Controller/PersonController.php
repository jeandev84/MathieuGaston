<?php
namespace App\Controller;

use App\Entity\Person;
use App\Repository\PersonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class PersonController
 * @package App\Controller
*/
class PersonController extends AbstractController
{
    /**
     * @Route("/persons", name="person.index")
     * @param PersonRepository $personRepository
     * @return Response
     */
    public function index(PersonRepository $personRepository)
    {
        return $this->render('person/index.html.twig', [
            'persons' => $personRepository->findAll()
        ]);
    }


    /**
     * @Route("/person/{id}", name="person.show")
     * @param Person $person
     * @return Response
     */
    public function show(Person $person)
    {
        return $this->render('person/show.html.twig', [
            'person' => $person
        ]);
    }
}
