<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Profile;
use AppBundle\Form\ProfileReviewForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/board")
 * @Security("is_granted('ROLE_BOARD')")
 */
class BoardController extends Controller
{

    /**
     * @Route("/profile/{id}/review",name="board-review-profile")
     */
    public function reviewProfileAction(Request $request, Profile $profile){

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ProfileReviewForm::class);

        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()){

            $comment = $request->request->get('comment');
            $approval = $request->request->get('approval');

            if ($approval =="Approved"){

                $nrApprovals = $profile->getNrBoardApprovals();

                if ($nrApprovals == 0 || $nrApprovals == ""){
                    $nrApprovals =1;
                    $profile->setNrBoardApprovals($nrApprovals);
                    $profile->setBoardApprover1($user);
                    $profile->setApproval1At(new \DateTime());
                    $profile->setBoardApprovalStatus1("Approved");
                }elseif ($nrApprovals == 1){
                    $nrApprovals =2;
                    $profile->setNrBoardApprovals($nrApprovals);
                    $profile->setBoardApprover2($user);
                    $profile->setApproval2At(new \DateTime());
                    $profile->setBoardApprovalStatus2("Approved");
                }elseif ($nrApprovals == 2){
                    $nrApprovals =3;
                    $profile->setNrBoardApprovals($nrApprovals);
                    $profile->setBoardApprover3($user);
                    $profile->setApproval3At(new \DateTime());
                    $profile->setBoardApprovalStatus3("Approved");
                    $profile->setIsBoardApproved(true);
                }

                $twigTemplate = "boardApproved.htm.twig";
                $accountStatus = "Prisk Membership Approved";
            }else{
                $profile->setIsBoardApproved(false);
                $profile->setIsBoardRejected(true);
                $profile->setBoardRejectionAt(new \DateTime());
                $profile->setBoardRejectionBy($user);
                $profile->setBoardRejectionReason($comment);

                $twigTemplate = "rejected.htm.twig";
                $accountStatus = "Prisk Portal Profile Status";
            }

            $profile->setStatusDescription($comment);
            $profile->setProcessedBy($user);
            $profile->setProcessedAt(new \DateTime());

            $em->persist($profile);
            $em->flush();

            //If All Board Members have approved, notify the user
            if ($profile->getNrBoardApprovals()==3) {
                $this->sendEmail($profile->getFirstName(), $accountStatus, $profile->getEmailAddress(), $twigTemplate, null);
            }
            return $this->redirectToRoute('membership-approved-profiles');
        }
        return $this->render('admin/profile/boardReview.htm.twig',[
            'profile'=>$profile,
            'boardReviewForm' => $form->createView()
        ]);
    }
    /**
     * @Route("/users/applications/actors",name="membership-approved-actor-profiles")
     */
    public function membershipApprovedProfileAction(){
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository("AppBundle:Profile")
            ->findAllMembershipApprovedActorProfilesOrderByDate();

        return $this->render('admin/membership-approved.htm.twig',[
            'users'=>$users
        ]);
    }
    /**
     * @Route("/users/applications/music",name="membership-approved-music-profiles")
     */
    public function membershipApprovedMusicianProfileAction(){
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository("AppBundle:Profile")
            ->findAllMembershipApprovedMusicianProfilesOrderByDate();

        return $this->render('admin/membership-approved.htm.twig',[
            'users'=>$users
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

}
