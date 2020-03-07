<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnimalRepository")
*/
class Animal
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * nom
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * description
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * image
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     * poids
     */
    private $weight;

    /**
     * @ORM\Column(type="boolean")
     * dangereux
    */
    private $dangerous;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getDangerous(): ?bool
    {
        return $this->dangerous;
    }

    public function setDangerous(bool $dangerous): self
    {
        $this->dangerous = $dangerous;

        return $this;
    }
}
