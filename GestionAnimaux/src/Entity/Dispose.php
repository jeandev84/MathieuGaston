<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="App\Repository\DisposeRepository")
 * @UniqueEntity(fields={"personnes", "animal"})
 *
 * Entite faisant la relation entre Person et Animal (1,n , 1,n)
 * nombre d'animals dont dispose une personne
*/
class Dispose
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Animal", inversedBy="disposes")
     */
    private $animal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Person", inversedBy="disposes")
     */
    private $personnes;

    /**
     * @ORM\Column(type="integer")
     * nombre d'animals dont dispose une personne
     */
    private $nb;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(?Animal $animal): self
    {
        $this->animal = $animal;

        return $this;
    }

    public function getPersonnes(): ?Person
    {
        return $this->personnes;
    }

    public function setPersonnes(?Person $personnes): self
    {
        $this->personnes = $personnes;

        return $this;
    }

    public function getNb(): ?int
    {
        return $this->nb;
    }

    public function setNb(int $nb): self
    {
        $this->nb = $nb;

        return $this;
    }
}
