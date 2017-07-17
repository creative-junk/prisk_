<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\AdministratorRegistrationForm;
use AppBundle\Form\LoginForm;
use AppBundle\Form\NewAdministratorForm;
use AppBundle\Form\ResetPasswordForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{

    /**
     * @Route("/account/{code}/activate",name="user-activate-account")
     */
    public function userFirstLoginAction(Request $request,$code){
        $em = $this->getDoctrine()->getManager();

        $idNumber = base64_decode($code);

        $profile = $em->getRepository("AppBundle:Profile")
            ->findOneBy([
                'idNumber'=>$code
            ]);
        $user = $profile->getWhoseProfile();
        //$user->setRoles('["R"]')
        $form = $this->createForm(ResetPasswordForm::class,$user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $user=$form->getData();
            $user->setIsPasswordCreated(true);
            $em->persist($user);
            $em->flush();

            return $this->render('user/accountUpdated.htm.twig');
        }

        if ($user->getIsPasswordCreated()){
            $activated = true;
        }else{
            $activated = false;
        }

        return $this->render('user/activate.htm.twig',[
            'user'=>$user,
            'activationForm'=>$form->createView(),
            'isActivated'=>$activated
        ]);
    }
    /**
     * @Route("/account/admin/{id}/activate",name="user-activate-account")
     */
    public function adminFirstLoginAction(Request $request,User $user){
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ResetPasswordForm::class,$user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $user=$form->getData();
            $user->setIsPasswordCreated(true);
            $em->persist($user);
            $em->flush();

            return $this->render('user/adminAccountUpdated.htm.twig');
        }

        if ($user->getIsPasswordCreated()){
            $activated = true;
        }else{
            $activated = false;
        }

        return $this->render('user/adminAactivate.htm.twig',[
            'user'=>$user,
            'activationForm'=>$form->createView(),
            'isActivated'=>$activated
        ]);
    }
    /**
     * @Route("/account/{code}/reset-password",name="user-reset-password")
     */
    public function resetPasswordAction(Request $request,$code){
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository("AppBundle:User")
            ->findOneBy([
                'passwordResetToken'=>$code
            ]);

        $form = $this->createForm(ResetPasswordForm::class,$user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $user=$form->getData();
            $user->setIsResetTokenValid(false);
            $em->persist($user);
            $em->flush();

            return $this->render('user/passwordUpdated.htm.twig');
        }

        if ($user->getIsResetTokenValid()){
            $validToken = true;
        }else{
            $validToken = false;
        }

        return $this->render('user/reset-password.htm.twig',[
            'user'=>$user,
            'passwordResetForm'=>$form->createView(),
            'isTokenValid'=>$validToken
        ]);
    }
    /**
     * @Route("/login/",name="login")
     *
     */
    public function loginUserAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(LoginForm::class,[
            '_username' => $lastUsername
        ]);

        return $this->render(
            'user/login.htm.twig',
            array(
                'loginForm' => $form->createView(),
                'error' => $error,
            ));
    }

    /**
     * @Route("/account/request",name="request-admin-account")
     */
    public function requestAccountAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $user = new User();
        $user->setIsActive(false);
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setIsPasswordCreated(false);

        $form = $this->createForm(AdministratorRegistrationForm::class,$user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();

            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute("admin-account-requested");
        }
        return $this->render(':admin:register.htm.twig',[
            'registerForm'=>$form->createView()
        ]);

    }
    /**
     * @Route("/account/admin/requested",name="admin-account-requested")
     */
    public function accountCreatedAction(Request $request){
        return $this->render(':admin:created.htm.twig');
    }

    /**
     * @Route("/login/admin",name="admin-login")
     *
     */
    public function loginAdminAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(LoginForm::class,[
            '_username' => $lastUsername
        ]);

        return $this->render(
            'admin/login.htm.twig',
            array(
                'loginForm' => $form->createView(),
                'error' => $error,
            ));
    }

    /**
     * @Route("/logout",name="security_logout")
     */
    public function logoutAction(){
        throw new \Exception('This should not be reached');
    }
    /**
     * @Route("/logout",name="user_logout")
     */
    public function logoutUserAction(){
        throw new \Exception('This should not be reached');
    }
}
