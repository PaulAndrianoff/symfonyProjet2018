<?php

namespace App\Repository;

use App\Entity\Wishe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Wishe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wishe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wishe[]    findAll()
 * @method Wishe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WisheRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Wishe::class);
    }

//    /**
//     * @return Wishe[] Returns an array of Wishe objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Wishe
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
