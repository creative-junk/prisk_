<?php
/*********************************************************************************
 * Developed by Maxx Ng'ang'a
 * (C) 2017 Crysoft Dynamics Ltd
 * Karbon V 2.1
 * User: Maxx
 * Date: 6/12/2017
 * Time: 3:16 PM
 ********************************************************************************/

namespace AppBundle\Repository;
use AppBundle\Entity\Onboard;
use Doctrine\ORM\EntityRepository;

class OnboardRepository extends EntityRepository
{
    public function findNrOnboards(){
        $nrOnboards= $this->createQueryBuilder('onboards')
            ->select('count(onboards.id)')
            ->getQuery()
            ->getSingleScalarResult();
        if ($nrOnboards){
            return $nrOnboards;
        }else{
            return 0;
        }
    }
    /**
     * @return Onboard[]
     */
    public function findAllUsers(){

        return $this->createQueryBuilder('user')
            ->orderBy('user.firstName','DESC')
            ->getQuery()
            ->execute();
    }
}