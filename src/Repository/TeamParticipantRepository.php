<?php

namespace App\Repository;

use App\Entity\TeamParticipant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TeamParticipant|null find($id, $lockMode = null, $lockVersion = null)
 * @method TeamParticipant|null findOneBy(array $criteria, array $orderBy = null)
 * @method TeamParticipant[]    findAll()
 * @method TeamParticipant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeamParticipantRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TeamParticipant::class);
    }

//    /**
//     * @return TeamParticipant[] Returns an array of TeamParticipant objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TeamParticipant
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
