<?php
/*********************************************************************************
 * Developed by Maxx Ng'ang'a
 * (C) 2017 Crysoft Dynamics Ltd
 * Karbon V 2.1
 * User: Maxx
 * Date: 5/12/2017
 * Time: 1:03 PM
 ********************************************************************************/

namespace AppBundle\Repository;


use AppBundle\Entity\Recording;
use Doctrine\ORM\EntityRepository;

class RecordingRepository extends EntityRepository
{
    /**
     * @return Recording[]
     */
    public function findAllRecordings(){

        return $this->createQueryBuilder('user')
            ->orderBy('user.createdAt','DESC')
            ->getQuery()
            ->execute();
    }
}