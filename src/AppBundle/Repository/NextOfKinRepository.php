<?php
/*********************************************************************************
 * Developed by Maxx Ng'ang'a
 * (C) 2017 Crysoft Dynamics Ltd
 * Karbon V 2.1
 * User: Maxx
 * Date: 6/15/2017
 * Time: 3:57 PM
 ********************************************************************************/

namespace AppBundle\Repository;

use AppBundle\Entity\NextOfKin;
use Doctrine\ORM\EntityRepository;

class NextOfKinRepository extends EntityRepository
{
    /**
     * @return NextOfKin[]
     */
    public function findMyKin($user){

        return $this->createQueryBuilder('nextOfKin')
            ->andWhere('nextOfKin.whoseKin = :whoseKin')
            ->setParameter(':whoseKin',$user)
            ->orderBy('nextOfKin.createdAt','ASC')
            ->getQuery()
            ->execute();
    }
}