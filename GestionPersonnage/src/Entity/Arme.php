<?php
namespace App\Entity;


/**
 * Class Arme
 * @package App\Entity
*/
class Arme
{
   private $nom;
   private $description;
   private $degat;

   public static $armes = [];

    /**
     * Arme constructor.
     * @param $nom
     * @param $description
     * @param $degat
   */
   public function __construct($nom, $description, $degat)
   {
       $this->nom = $nom;
       $this->description = $description;
       $this->degat = $degat;
       self::$armes[] = $this;
   }


    /**
     * @return mixed
    */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     * @return Arme
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return Arme
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
    */
    public function getDegat()
    {
        return $this->degat;
    }

    /**
     * @param mixed $degat
     * @return Arme
    */
    public function setDegat($degat)
    {
        $this->degat = $degat;
        return $this;
    }


    public static function creerArme()
    {
        new Arme("epee", "Une superbe epee tranchante", 10);
        new Arme("hache", "Une arme ou un outil", 15);
        new Arme("arc", "Une arme a distance", 7);
    }

    /**
     * @param $nom
     * @return mixed
    */
    public static function getArmeParNom($nom)
    {
        foreach (self::$armes as $arme)
        {
            if(strtolower(str_replace('é', 'e', $arme->nom)) === $nom)
            {
                return $arme;
            }
        }
    }
}