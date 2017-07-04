<?php

namespace AppBundle\Controller;

use AppBundle\Entity\NextOfKin;
use AppBundle\Entity\Profile;
use AppBundle\Entity\Recording;
use AppBundle\Form\NextOfKinForm;
use AppBundle\Form\ProfileForm;
use AppBundle\Form\RecordingForm;
use AppBundle\Form\RecordingMp3FormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
/**
 * @Route("/home")
 * @Security("is_granted('ROLE_USER')")
 *
 */
class UserController extends Controller
{
    /**
     * @Route("/",name="home")
     */
    public function dashboardAction(){
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $profile = $user->getMyProfile();

        if (!$profile){
            $profile = "";
        }

        return $this->render('home/home.htm.twig',[
            'profile'=>$profile
        ]);
    }
    /**
     * @Route("/recordings",name="my-recordings")
     */
    public function myRecordingsAction(Request $request){

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:Recording')
            ->createQueryBuilder('recording')
            ->andWhere('recording.createdBy = :createdBy')
            ->setParameter('createdBy', $user);

        $query = $queryBuilder->getQuery();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 9)
        );
        return $this->render('home/recording/list.html.twig', [
            'recordings' => $result,
        ]);
    }
    /**
     * @Route("/recording/new",name="add-recording")
     */
    public function addRecordingAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $recording = new Recording();
        $recording->setMainArtist($user);
        $recording->setCreatedBy($user);
        $recording->setCreatedAt(new \DateTime());
        $recording->setUpdatedBy($user);
        $recording->setUpdatedAt(new \DateTime());
        $recording->setStatus("Submitted");
        $form = $this->createForm(RecordingForm::class, $recording);

        //only handles data on POST
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recording = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($recording);
            $em->flush();

            $this->addFlash('success', 'Product Updated Successfully!');

            return $this->redirectToRoute('my-recordings');
        }

        return $this->render('home/recording/new.html.twig', [
            'recordingForm' => $form->createView()
        ]);

    }
    /**
     * @Route("/recording/{id}/edit",name="edit-recording")
     */
    public function editRecordingAction(Request $request,Recording $recording){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $recording->setUpdatedBy($user);
        $recording->setUpdatedAt(new \DateTime());
        $form = $this->createForm(RecordingForm::class, $recording);

        //only handles data on POST
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recording = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($recording);
            $em->flush();

            $this->addFlash('success', 'Recording Updated Successfully!');

            return $this->redirectToRoute('my-recordings');
        }

        return $this->render('home/recording/update.html.twig', [
            'recordingForm' => $form->createView()
        ]);

    }
    /**
     * @Route("/recording/view/{id}",name="view-recording")
     */
    public function viewRecordingAction(Request $request,Recording $recording){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        return $this->render('home/recording/details.htm.twig', [
            'recording' => $recording,


        ]);

    }

    /**
     * @Route("/recording/{id}/new/",name="new-mp3")
     */
    public function addMp3Action(Request $request,Recording $recording){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $form = $this->createForm(RecordingMp3FormType::class,$recording);

        //only handles data on POST
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recordings = $form->getData();
           // var_dump($recordings);exit;
            $em = $this->getDoctrine()->getManager();
            $em->persist($recordings);
            $em->flush();

            $this->addFlash('success', 'Recording Updated Successfully!');

            return $this->redirectToRoute('my-recordings');
        }else{
            $errors = $form->getErrors();
        }

        return $this->render('home/recording/newMp3.html.twig', [
            'recording' => $recording,
            'recordingForm' => $form->createView(),
            'errors'=>$errors
        ]);
    }


    /**
     * @Route("/next-of-kin/new",name="add-next-of-kin")
     */
   public function addNextOfKinAction(Request $request){
       $user = $this->get('security.token_storage')->getToken()->getUser();

       $nextOfKin = new NextOfKin();
       $nextOfKin->setCreatedAt(new \DateTime());
       $nextOfKin->setUpdatedAt(new \DateTime());
       $nextOfKin->setWhoseKin($user);

       $form = $this->createForm(NextOfKinForm::class, $nextOfKin);

       //only handles data on POST
       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {

           $nextOfKin = $form->getData();

           $em = $this->getDoctrine()->getManager();
           $em->persist($nextOfKin);
           $em->flush();

           return $this->redirectToRoute('my-next-of-kin');
       }

       return $this->render('home/nextOfKin/new.html.twig', [
           'nextOfKinForm' => $form->createView()
       ]);
   }
    /**
     * @Route("/next-of-kin",name="my-next-of-kin")
     */
    public function listKinAction(Request $request){

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();
        $nextOfKin = $em->getRepository('AppBundle:NextOfKin')
            ->findMyKin($user);

        return $this->render('home/nextOfKin/list.html.twig', [
            'kinsList' => $nextOfKin
        ]);
    }
    /**
     * @Route("/next-of-kin/{id}/view",name="view-kin-details")
     */
    public function viewNextOfKinAction(Request $request,NextOfKin $nextOfKin){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        return $this->render('home/nextOfKin/details.htm.twig', [
            'nextOfKin' => $nextOfKin,
        ]);

    }
    /**
     * @Route("/next-of-kin/{id}/edit",name="edit-next-of-kin")
     */
    public function editNextOfKinAction(Request $request,NextOfKin $nextOfKin){
        $user = $this->get('security.token_storage')->getToken()->getUser();


        $form = $this->createForm(NextOfKinForm::class, $nextOfKin);

        //only handles data on POST
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $nextOfKin = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($nextOfKin);
            $em->flush();

            return $this->redirectToRoute('my-next-of-kin');
        }

        return $this->render('home/nextOfKin/new.html.twig', [
            'nextOfKinForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit-profile",name="edit-profile")
     */
    public function myProfileAction(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $profile = $user->getMyProfile();

        $form = $this->createForm(ProfileForm::class,$profile);

        $form->handleRequest($request);

        if($form->isValid()){
            $profile = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($profile);
            $em->flush();


            return $this->redirectToRoute('home');
        }else{
            $errors = $form->getErrors();
        }

        return $this->render(':profile:edit.htm.twig',[
            'profileForm'=>$form->createView(),
            'profile'=>$profile,
            'errors'=>$errors
        ]);
    }
}
