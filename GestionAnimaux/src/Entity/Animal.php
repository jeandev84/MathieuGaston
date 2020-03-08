<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Familly", inversedBy="animals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $familly;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Continent", mappedBy="animals")
     */
    private $continents;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Dispose", mappedBy="animal")
     */
    private $disposes;

    public function __construct()
    {
        $this->continents = new ArrayCollection();
        $this->disposes = new ArrayCollection();
    }


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

    public function getFamilly(): ?Familly
    {
        return $this->familly;
    }

    public function setFamilly(?Familly $familly): self
    {
        $this->familly = $familly;

        return $this;
    }

    /**
     * @return Collection|Continent[]
     */
    public function getContinents(): Collection
    {
        return $this->continents;
    }

    public function addContinent(Continent $continent): self
    {
        if (!$this->continents->contains($continent)) {
            $this->continents[] = $continent;
            $continent->addAnimal($this);
        }

        return $this;
    }

    public function removeContinent(Continent $continent): self
    {
        if ($this->continents->contains($continent)) {
            $this->continents->removeElement($continent);
            $continent->removeAnimal($this);
        }

        return $this;
    }

    /**
     * @return Collection|Dispose[]
     */
    public function getDisposes(): Collection
    {
        return $this->disposes;
    }

    public function addDispose(Dispose $dispose): self
    {
        if (!$this->disposes->contains($dispose)) {
            $this->disposes[] = $dispose;
            $dispose->setAnimal($this);
        }

        return $this;
    }

    public function removeDispose(Dispose $dispose): self
    {
        if ($this->disposes->contains($dispose)) {
            $this->disposes->removeElement($dispose);
            // set the owning side to null (unless already changed)
            if ($dispose->getAnimal() === $this) {
                $dispose->setAnimal(null);
            }
        }

        return $this;
    }
}
