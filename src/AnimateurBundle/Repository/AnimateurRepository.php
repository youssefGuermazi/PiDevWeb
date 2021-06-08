<?php

namespace AnimateurBundle\Repository;

/**
 * AnimateurRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AnimateurRepository extends \Doctrine\ORM\EntityRepository
{

    public function findFormation($id)
    {
        $query = $this->getEntityManager()->createQuery(
            'select A from AnimateurBundle:Animateur_formation A where A.idformateur = :id')
            ->setParameter(':id', $id);
        return $query->getResult();
    }

}
