<?php

namespace App\Repository;

use App\Entity\TypeRevu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeRevu|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeRevu|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeRevu[]    findAll()
 * @method TypeRevu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeRevuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeRevu::class);
    }

    // /**
    //  * @return TypeRevu[] Returns an array of TypeRevu objects
    //  */
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
    public function findOneBySomeField($value): ?TypeRevu
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
