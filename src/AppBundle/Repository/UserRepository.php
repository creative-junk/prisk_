<?php
/*********************************************************************************
 * Developed by Maxx Ng'ang'a
 * (C) 2017 Crysoft Dynamics Ltd
 * Karbon V 2.1
 * User: Maxx
 * Date: 6/12/2017
 * Time: 3:17 PM
 ********************************************************************************/

namespace AppBundle\Repository;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function findNrUsers(){
        $nrUsers= $this->createQueryBuilder('user')
            ->select('count(user.id)')
            ->getQuery()
            ->getSingleScalarResult();
        if ($nrUsers){
            return $nrUsers;
        }else{
            return 0;
        }
    }
    public function findNrPendingUsers(){
        $nrUsers= $this->createQueryBuilder('user')
            ->select('count(user.id)')
            ->andWhere('user.isPasswordCreated = :passwordCreated')
            ->setParameter(':passwordCreated',false)
            ->getQuery()
            ->getSingleScalarResult();
        if ($nrUsers){
            return $nrUsers;
        }else{
            return 0;
        }
    }
    /**
     * @return User[]
     */
    public function findAllUsers(){

        return $this->createQueryBuilder('user')
            ->andWhere('user.roles = :userRole')
            ->setParameter(':userRole','["ROLE_USER"]')
            ->orderBy('user.profileLinkedAt','ASC')
            ->getQuery()
            ->execute();
    }
    /**
     * @return User[]
     */
    public function findAllAdministratorUsers(){

        return $this->createQueryBuilder('user')
            ->orWhere('user.roles != :isAdmin')
            ->setParameter(':isAdmin','["ROLE_USER"]')
            ->getQuery()
            ->execute();
    }
    /**
     * @return User[]
     */
    public function findAllPendingUsers(){

        return $this->createQueryBuilder('user')
            ->andWhere('user.isPasswordCreated = :passwordCreated')
            ->setParameter(':passwordCreated',false)
            ->orderBy('user.profileLinkedAt','ASC')
            ->getQuery()
            ->execute();
    }
    /**
     * @return User[]
     */
    public function findAllPendingAdminUsers(){

        return $this->createQueryBuilder('user')
            ->andWhere('user.isPasswordCreated = :passwordCreated')
            ->setParameter(':passwordCreated',false)
            ->andWhere('user.roles = :isAdmin')
            ->setParameter(':isAdmin','["ROLE_ADMIN"]')
            ->getQuery()
            ->execute();
    }
}