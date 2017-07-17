<?php
/**
 * Created by PhpStorm.
 * User: Mgeni
 * Date: 5/24/2017
 * Time: 3:53 PM
 */
namespace AppBundle\Controller\Admin;

use AppBundle\Entity\NextOfKin;
use AppBundle\Entity\Profile;
use AppBundle\Entity\User;
use AppBundle\Form\NewAdministratorForm;
use AppBundle\Form\ProfileReviewForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use WhiteOctober;

/**
 * @Route("/admin")
 * @Security("is_granted('ROLE_ADMINISTRATOR')")
 *
 */
class AdminController extends Controller
{
    /**
     * @Route("/users/admin/pending",name="pending-admin-accounts")
     */
    public function pendingAdminAction(){
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository("AppBundle:User")
            ->findAllPendingAdminUsers();

        return $this->render('admin/pending-admin-accounts.htm.twig',[
            'users'=>$users
        ]);
    }
    /**
     * @Route("/users/administrators",name="admin-accounts")
     */
    public function adminAccountsAction(){
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository("AppBundle:User")
            ->findAllAdministratorUsers();

        return $this->render('admin/admin-users.htm.twig',[
            'users'=>$users
        ]);
    }
    /**
     * @Route("/user/account/{id}/approve",name="approve-admin-account")
     */
    public function approveAccountAction(Request $request, User $user){
        $admin = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $user->setIsActive(true);
        $user->setIsPasswordCreated(true);
        $user->setApprovedBy($admin);

        $em->persist($user);
        $em->flush();

        $this->sendEmail($user->getFirstName(),"Administrator Account Approved",$user->getEmail(),"accountApproved.htm.twig",null);

        return new Response(null,204);
    }
    /**
     * @Route("/administrator/new",name="new-administrator")
     */
    public function newAdministratorAction(Request $request){
        $admin = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $accountToken = base64_encode(random_bytes(10));

        $user = new User();
        $user->setIsActive(true);
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setPlainPassword(base64_encode(random_bytes(10)));
        $user->setAccountCreatedBy($admin);
        $user->setPasswordResetToken($accountToken);

        $form = $this->createForm(NewAdministratorForm::class,$user);

        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()){
            $user=$form->getData();

            $em->persist($user);
            $em->flush();

            $this->sendEmail($user->getFirstName(),"Prisk Portal Administrator Account",$user->getEmail(),"accountCreated.htm.twig",$accountToken);

            return $this->redirectToRoute('admin-accounts');
        }

        return $this->render(':admin:new.htm.twig',[
            'adminForm'=>$form->createView()
        ]);
    }

    protected function sendEmail($firstName,$subject,$emailAddress,$twigTemplate,$code){
        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom('prisk@creative-junk.com','PRISK Online Portal Team')
            ->setTo($emailAddress)
            ->setBody(
                $this->renderView(
                    'Emails/'.$twigTemplate,
                    array(
                        'name' => $firstName,
                        'code' => $code
                    )
                ),
                'text/html'
            );
        $this->get('mailer')->send($message);
    }

    /**
     * @Route("/member/update",name="update-member")
     */
    public function updateRoleFunction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $memberId = $request->request->get('pk');
        $roleValue = $request->request->get('value');

        switch ($roleValue) {
            case 1:
                $role = ["ROLE_MEMBERSHIP"];
                break;
            case 2:
                $role = ["ROLE_MUSIC_DIRECTOR"];
                break;
            case 3:
                $role = ["ROLE_ACTOR_DIRECTOR"];
                break;
            case 4:
                $role = ["ROLE_ADMINISTRATOR"];
                break;
            default:
                $role = ["ROLE_MEMBERSHIP"];
                break;
        }

        $member = $em->getRepository("AppBundle:User")
            ->findOneBy([
                'id'=>$memberId
            ]);

        if ($member){
            $member->setRoles($role);
            $em->persist($member);
            $em->flush();
            return new Response(null,200);
        }else{
            return new Response(null,500);
        }
    }

}
