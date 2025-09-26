<?php

namespace App\Repository;

use App\Entity\Core;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Core>
 */
class CoreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Core::class);
    }

//    /**
//     * @return Core[] Returns an array of Core objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Core
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

      public function findBudgetMinusWarning() {
           return $this->createQueryBuilder('c')
            ->select('c.rel_id as id')
            ->where("c.type = 'budget' ")
            ->andwhere('c.deleted = 0')
            ->getQuery()
            ->getArrayResult();
      }

      public function findUnpaidInvoiceWarning() {
           return $this->createQueryBuilder('c')
            ->select('c.rel_id as id')
            ->where("c.type = 'invoice' ")
            ->andwhere('c.deleted = 0')
            ->getQuery()
            ->getArrayResult();
      }

}
