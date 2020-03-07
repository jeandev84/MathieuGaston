<?php
namespace App\Entity;


/**
 * Class Personnage
 * @package App\Entity
*/
class Personnage
{
    /*
     $person1 = [
            'nom' => 'Marc',
            'age' => 25,
            'sexe' => true,
            'caract' => [
                'force' => 3,
                'agi' => 2,
                'intel' => 3
            ]
        ];
    */

    public $nom;
    public $age;
    public $sexe;
    public $caract = [];


    public static $personnages = [];

    /**
     * Personnage constructor.
     * @param string $nom
     * @param int $age
     * @param string $sexe
     * @param array $caract
     */
    public function __construct($nom, $age, $sexe, $caract)
    {
        $this->nom = $nom;
        $this->age = $age;
        $this->sexe = $sexe;
        $this->caract = $caract;

        // On remplit notre tableau de personnages des que la classe est appelle
        self::$personnages[] = $this;
    }

    /**
     * Create personnage
    */
    public static function creerPersonnage()
    {
        $p1 = new Personnage('Marc', 25, true, [
            'force' => 3,
            'agi' => 2,
            'intel' => 3
        ]);

        $p2 = new Personnage('Milo', 30, true, [
            'force' => 5,
            'agi' => 1,
            'intel' => 2
        ]);

        $p3 = new Personnage('Tya', 22, true, [
            'force' => 1,
            'agi' => 2,
            'intel' => 5
        ]);
    }

    /**
     * @param $nom
     * @return mixed
    */
    public static function getPersonnageParNom($nom)
    {
        foreach (self::$personnages as $personnage)
        {
            if(strtolower($personnage->nom) === $nom)
            {
                return $personnage;
            }
        }
    }
}