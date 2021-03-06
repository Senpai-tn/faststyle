<?php

namespace AlaaBundle\Repository;

/**
 * OrdersRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class OrdersRepository extends \Doctrine\ORM\EntityRepository
{

    public function getDays(\DateTime $firstDateTime, \DateTime $lastDateTime)
    {
        $qb = $this->getEntityManager()->createQueryBuilder()
            ->select('o')
            ->from('AlaaBundle:Orders', 'o')
            ->where('o.orderDate BETWEEN :firstDate AND :lastDate')
            ->setParameter('firstDate', $firstDateTime)
            ->setParameter('lastDate', $lastDateTime)
        ;

        $result = $qb->getQuery()->getResult();

        return $result;
    }
}
