<?php

namespace GarderieBundle\Repository;

/**
 * GarderieRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GarderieRepository extends \Doctrine\ORM\EntityRepository
{
    public function getGarderieByResponsable($id)
    {
        $Query = $this->getEntityManager()->createQuery(
            "SELECT A FROM GarderieBundle:Garderie A   WHERE A.cin_resp = :p")
            ->setParameter('p',$id);

        return $Query->getResult();
    }
}
