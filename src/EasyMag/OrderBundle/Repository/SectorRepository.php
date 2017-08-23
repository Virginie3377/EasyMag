<?php

namespace EasyMag\OrderBundle\Repository;

/**
 * SectorRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SectorRepository extends \Doctrine\ORM\EntityRepository
{
    public function find3LastSectorByCommercial($commercial) {
        $qb = $this->createQueryBuilder('s')
            ->where('s.commercial = :commercial')
            ->setParameter('commercial', $commercial)
            ->orderBy('s.datepublication','desc')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
        return $qb;
    }
}
