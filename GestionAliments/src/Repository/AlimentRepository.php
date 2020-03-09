<?php

namespace App\Repository;

use App\Entity\Aliment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Aliment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Aliment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Aliment[]    findAll()
 * @method Aliment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlimentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Aliment::class);
    }

    /**
     * Recuperer tous les aliments inferieur a la valeur en parametre
     * @param string $property
     * @param string $signe
     * @param $calorie
     * @return mixed
     */
    /*
    public function getAlimentByNumberCalorie($calorie)
    {
        return $this->createQueryBuilder('a')
                   ->andWhere('a.calorie < :calorie')
                   ->setParameter('calorie', $calorie)
                   ->getQuery()
                   ->getResult();
    }
    public function getAlimentProperty(string $property, string $signe, $value)
    {
        return $this->createQueryBuilder('a')
                  //->andWhere('a.'. $property .' '. $signe .' :val')
                    ->andWhere(sprintf('a.%s %s :val', $property, $value))
                    ->setParameter('val', $value)
                    ->getQuery()
                    ->getResult();
    }
    */




    /**
     * Recuperer tous les aliments inferieur a la valeur en parametre
     * @param string $property
     * @param string $signe
     * @param $value
     * @return mixed
   */
    public function getAlimentByProperty(string $property, string $signe, $value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere(sprintf('a.%s %s :val', $property, $signe))
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult();
    }


    // /**
    //  * @return Aliment[] Returns an array of Aliment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Aliment
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

}
