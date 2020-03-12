<?php
namespace App\Entity\Filter;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class RechercheVoiture
 * @package App\Entity\Filter
*/
class RechercheVoiture
{
    /**
     * @Assert\LessThanOrEqual(
     *     propertyPath="maxAnnee",
     *     message="doit etre plus petit que l'annee Max"
     * )
     * @var int
    */
    private $minAnnee;

    /**
     * @Assert\GreaterThanOrEqual(
     *     propertyPath="minAnnee",
     *     message="doit etre plus petit que l'annee Min"
     * )
     * @var int
    */
    private $maxAnnee;

    /**
     * @return int|null
     */
    public function getMinAnnee(): ?int
    {
        return $this->minAnnee;
    }

    /**
     * @param int|null $minAnnee
     * @return RechercheVoiture
     */
    public function setMinAnnee(?int $minAnnee): RechercheVoiture
    {
        $this->minAnnee = $minAnnee;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMaxAnnee(): ?int
    {
        return $this->maxAnnee;
    }

    /**
     * @param int $maxAnnee
     * @return RechercheVoiture
     */
    public function setMaxAnnee(int $maxAnnee): RechercheVoiture
    {
        $this->maxAnnee = $maxAnnee;
        return $this;
    }

}