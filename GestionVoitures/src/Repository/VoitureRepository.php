<?php

namespace App\Repository;

use App\Entity\Filter\RechercheVoiture;
use App\Entity\Voiture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method Voiture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voiture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voiture[]    findAll()
 * @method Voiture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoitureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voiture::class);
    }


    /**
     * @param RechercheVoiture $rechercheVoiture
     * @return Query
     */
    public function findAllWithPagination(RechercheVoiture $rechercheVoiture): Query
    {
        $req = $this->createQueryBuilder('v');

        if($minAnnee = $rechercheVoiture->getMinAnnee())
        {
            $req = $req->andWhere('v.annee >= :min')
                       ->setParameter('min', $minAnnee);
        }

        if($maxAnnee = $rechercheVoiture->getMaxAnnee())
        {
            $req = $req->andWhere('v.annee <= :max')
                       ->setParameter('max', $maxAnnee);
        }

        return $req->getQuery();
    }

    // /**
    //  * @return Voiture[] Returns an array of Voiture objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Voiture
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
