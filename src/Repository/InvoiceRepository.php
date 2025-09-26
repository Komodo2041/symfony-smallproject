<?php

namespace App\Repository;

use App\Entity\Invoice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Invoice>
 */
class InvoiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Invoice::class);
    }

    public function findUnpaidInvoice() {
         
        return $this->createQueryBuilder('i')
            ->select('i.id')
            ->where('i.delayed_date < :currentDate ')
            ->andwhere('i.status = 0')
            ->andwhere('i.deleted = 0')
            ->setParameter('currentDate', new \DateTimeImmutable('today'))
            ->getQuery()
            ->getArrayResult();
 
    } 
}
