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

use AppBundle\Entity\Profile;
use Doctrine\ORM\EntityRepository;

class ProfileRepository extends EntityRepository
{
    /**
     * @return Profile[]
     */
    public function findAllOpenProfilesOrderByDate(){

        return $this->createQueryBuilder('profile')
            ->orderBy('profile.createdAt','DESC')
            ->andWhere('profile.isPaid = :isPaid')
            ->setParameter(':isPaid',true)
            ->andWhere('profile.profileStatus = :isApproved')
            ->setParameter(':isApproved','Pending')
            ->getQuery()
            ->execute();
    }
    /**
     * @return Profile[]
     */
    public function findAllApprovedProfilesOrderByDate(){

        return $this->createQueryBuilder('profile')
            ->orderBy('profile.createdAt','DESC')
            ->andWhere('profile.isPaid = :isPaid')
            ->setParameter(':isPaid',true)
            ->andWhere('profile.profileStatus = :isApproved')
            ->setParameter(':isApproved',"Approved")
            ->getQuery()
            ->execute();
    }
    /**
     * @return Profile[]
     */
    public function findAllRejectedProfilesOrderByDate(){

        return $this->createQueryBuilder('profile')
            ->orderBy('profile.createdAt','DESC')
            ->andWhere('profile.isPaid = :isPaid')
            ->setParameter(':isPaid',true)
            ->andWhere('profile.profileStatus = :isApproved')
            ->setParameter(':isApproved',"Rejected")
            ->getQuery()
            ->execute();
    }
    /**
     * @return Profile[]
     */
    public function findAllUnpaidProfilesOrderByDate(){

        return $this->createQueryBuilder('profile')
            ->orderBy('profile.createdAt','DESC')
            ->andWhere('profile.isPaid = :isPaid')
            ->setParameter(':isPaid',false)
            ->getQuery()
            ->execute();
    }
    public function findNrProfiles(){
        $nrProfiles= $this->createQueryBuilder('profile')
            ->select('count(profile.id)')
            ->getQuery()
            ->getSingleScalarResult();
        if ($nrProfiles){
            return $nrProfiles;
        }else{
            return 0;
        }
    }
    public function findNrApproved(){
        $nrProfiles= $this->createQueryBuilder('profile')
            ->select('count(profile.id)')
            ->andWhere('profile.profileStatus = :isApproved')
            ->setParameter(':isApproved','Approved')
            ->getQuery()
            ->getSingleScalarResult();
        if ($nrProfiles){
            return $nrProfiles;
        }else{
            return 0;
        }
    }
    public function findNrRejected(){
        $nrProfiles= $this->createQueryBuilder('profile')
            ->select('count(profile.id)')
            ->andWhere('profile.profileStatus = :isApproved')
            ->setParameter(':isApproved','Rejected')
            ->getQuery()
            ->getSingleScalarResult();
        if ($nrProfiles){
            return $nrProfiles;
        }else{
            return 0;
        }
    }
    public function findNrUnderReview(){
        $nrProfiles= $this->createQueryBuilder('profile')
            ->select('count(profile.id)')
            ->andWhere('profile.isPaid = :isPaid')
            ->setParameter(':isPaid',true)
            ->andWhere('profile.profileStatus = :isApproved')
            ->setParameter(':isApproved','')
            ->getQuery()
            ->getSingleScalarResult();
        if ($nrProfiles){
            return $nrProfiles;
        }else{
            return 0;
        }
    }
    public function findNrUnpaidProfiles(){
        $nrProfiles= $this->createQueryBuilder('profile')
            ->select('count(profile.id)')
            ->andWhere('profile.isPaid = :isPaid')
            ->setParameter(':isPaid',false)
            ->andWhere('profile.profileStatus = :isApproved')
            ->setParameter(':isApproved','')
            ->getQuery()
            ->getSingleScalarResult();
        if ($nrProfiles){
            return $nrProfiles;
        }else{
            return 0;
        }
    }
    public function findNrNew(){
        $nrProfiles= $this->createQueryBuilder('profile')
            ->select('count(profile.id)')
            ->andWhere('profile.createdAt > :createdAt')
            ->setParameter('createdAt', new \DateTime('-5 days'))
            ->getQuery()
            ->getSingleScalarResult();
        if ($nrProfiles){
            return $nrProfiles;
        }else{
            return 0;
        }
    }
}