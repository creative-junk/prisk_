<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Documents;
use AppBundle\Entity\Onboard;
use AppBundle\Entity\Profile;
use AppBundle\Form\DocumentsFormType;
use AppBundle\Form\MpesaFormType;
use AppBundle\Form\ProfileForm;
use Crysoft\MpesaBundle\Helpers\Mpesa;
use Crysoft\MpesaBundle\Helpers\MpesaStatus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
    /**
     * @Route("/profile/updated",name="profile_updated")
     */
    public function profileCompleteAction()
    {
        return $this->render('profile/updated.htm.twig');
    }

    /**
     * @Route("/profile/{id}/update")
     */
    public function profileAction(Request $request, Onboard $onboard)
    {
        $profile = new Profile();
        $profile->setFirstName($onboard->getFirstName());
        $profile->setLastName($onboard->getLastName());
        $profile->setIdNumber($onboard->getIdNumber());
        $profile->setStageName($onboard->getStageName());
        $profile->setEmailAddress($onboard->getEmail());
        $profile->setProfileStatus("Pending");
        $profile->setRegistrationDate(new \DateTime());
        $profile->setSourceOfData("Self");
        $profile->setCreatedAt(new \DateTimeImmutable());
        $form = $this->createForm(ProfileForm::class, $profile);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $profile = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $payment = $request->request->get('payment');
            $em->persist($profile);
            $em->flush();
            if ($payment == 'pay') {
                $this->sendWelcomeEmail($onboard->getfirstName(), $onboard->getEmail(), $onboard->getId());
                $this->container->get('session')->set('profile', $profile);
                return $this->redirectToRoute('pay_mpesa');

            } else {
                $this->sendUnpaidWelcomeEmail($onboard->getfirstName(), $onboard->getEmail(), $onboard->getId());
                return $this->redirectToRoute('profile_updated', array('profileId' => $profile->getId()));
            }
        } else {
            $errors = $form->getErrors();
        }
        return $this->render(':profile:new.htm.twig', ['profileForm' => $form->createView(), 'profile' => $profile, 'errors' => $errors]);
    }

    /**
     * @Route("/profile/mpesa/pay",name="pay_mpesa")
     */
    public function mpesaPayAction(Request $request)
    {
        $profile = $this->container->get('session')->get('profile');
        $em = $this->getDoctrine()->getManager();
        $userProfile = $em->getRepository("AppBundle:Profile")->findOneBy(['id' => $profile->getId()]);
        $form = $this->createForm(MpesaFormType::class, $userProfile);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->container->get('session')->set('profile', $userProfile);
            $amount = 10;
            $phoneNumber = $form["phoneNumber"]->getData();
            $referenceId = $userProfile->getIdNumber();
            $mpesa = new Mpesa($this->container);
            $transactionId = $mpesa->generateTransactionNumber();
            $response = $mpesa->request($amount)->from($phoneNumber)->usingReferenceId($referenceId)->usingTransactionId($transactionId)->transact();
            $statusCode = $response->getStatusCode();
            $this->container->get('session')->set('transactionId', $transactionId);
            if ($statusCode == 200) {
                return $this->redirectToRoute('mpesa_paid');
            } else {
                return $this->redirectToRoute('mpesa_failed');
            }

        }
        return $this->render('profile/pay.htm.twig', ['profile' => $userProfile, 'mpesaForm' => $form->createView()]);
    }

    /**
     * @Route("/profile/mpesa/complete-payment",name="mpesa_paid")
     */
    public function paySuccessAction(Request $request)
    {
        return $this->render(':profile:success.htm.twig');
    }

    /**
     * @Route("/profile/mpesa/failed",name="mpesa_failed")
     */
    public function payFailedAction(Request $request)
    {

    }

    /**
     * @Route("/profile/mpesa/verify",name="verify-payment")
     */
    public function completePaymentAction(Request $request)
    {
        $mpesa = new Mpesa($this->container);
        $profile = $this->container->get('session')->get('profile');
        $transactionId = $this->container->get('session')->get('transactionId');
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository("AppBundle:Profile")->findOneBy(['id' => $profile->getId()]);
        $response = $mpesa->usingTransactionId($transactionId)->requestStatus();
        //var_dump($response);exit;
        $mpesaStatus = new MpesaStatus($response);
        $customerNumber = $mpesaStatus->getCustomerNumber();
        $transactionAmount = $mpesaStatus->getTransactionAmount();
        $transactionStatus = $mpesaStatus->getTransactionStatus();
        $transactionDate = $mpesaStatus->getTransactionDate();
        $mPesaTransactionId = $mpesaStatus->getMpesaTransactionId();
        $merchantTransactionId = $mpesaStatus->getMerchantTransactionId();
        $transactionDescription = $mpesaStatus->getTransactionDescription();
        if ($transactionStatus == "Success") {
            $success = "Success";
            $user->setMpesaConfirmationCode($mPesaTransactionId);
            $user->setMpesaDescription($transactionDescription);
            $user->setMpesaPaymentDate(new \DateTime($transactionDate));
            $user->setMpesaStatus($transactionStatus);
            $user->setIsPaid(true);
            $user->setMpesaNumber($customerNumber);
            $user->setMpesaAmount($transactionAmount);
            $em->persist($user);
            $em->flush();
            $transactionArray = array("a" => $mPesaTransactionId, "b" => $transactionDate, "c" => $customerNumber, "d" => $transactionAmount);
            /* $transactionCode ='<b>Mpesa Confirmation Code:<b>'..'<br/>
             <b>Mpesa Payment Date:<b>'..'<br/>
             <b>Mpesa Number:</b>'..'<br/>
             <b>Amount:</b>'.;*/
            $this->sendPaymentEmail($user->getFirstName(), $user->getEmailAddress(), $transactionArray);

        } else {
            $success = "Failed";
        }
        return $this->render(':profile:verification.htm.twig', ['profile' => $user, 'success' => $success]);
    }

    /**
     * @Route("/profile/{id}/edit")
     */
    public function editProfileAction(Request $request, Profile $profile)
    {
        $form = $this->createForm(ProfileForm::class, $profile);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $profile = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($profile);
            $em->flush();
            return $this->redirectToRoute('profile_updated', array('profileId' => $profile->getId()));
        } else {
            $errors = $form->getErrors();
        }
        return $this->render(':profile:new.htm.twig', ['profileForm' => $form->createView(), 'profile' => $profile, 'errors' => $errors]);
    }

    /**
     * @Route("/profile/{id}/pay",name="member-pay")
     */
    public function makePaymentAction(Request $request, Profile $userProfile)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(MpesaFormType::class, $userProfile);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->container->get('session')->set('profile', $userProfile);
            $amount = 10;
            $phoneNumber = $form["phoneNumber"]->getData();
            $referenceId = $userProfile->getIdNumber();
            $mpesa = new Mpesa($this->container);
            $transactionId = $mpesa->generateTransactionNumber();
            $response = $mpesa->request($amount)->from($phoneNumber)->usingReferenceId($referenceId)->usingTransactionId($transactionId)->transact();
            $statusCode = $response->getStatusCode();
            $this->container->get('session')->set('transactionId', $transactionId);
            if ($statusCode == 200) {
                return $this->redirectToRoute('mpesa_paid');
            } else {
                return $this->redirectToRoute('mpesa_failed');
            }

        }
        return $this->render('profile/pay.htm.twig', ['profile' => $userProfile, 'mpesaForm' => $form->createView()]);
    }

    public function sendPaymentEmail($firstName, $emailAddress, $code)
    {
        $message = \Swift_Message::newInstance()->setSubject('PRISK Online Portal Profile')->setFrom('portal@prisk.or.ke', 'PRISK Online Portal Team')->setTo($emailAddress)->setBody($this->renderView(// app/Resources/views/Emails/onboard.htm.twig
                'Emails/paid.htm.twig', array('name' => $firstName, 'code' => $code)), 'text/html');
        $this->get('mailer')->send($message);
    }

    public function sendWelcomeEmail($firstName, $emailAddress, $code)
    {
        $message = \Swift_Message::newInstance()->setSubject('PRISK Online Portal Profile')->setFrom('portal@prisk.or.ke', 'PRISK Online Portal Team')->setTo($emailAddress)->setBody($this->renderView(// app/Resources/views/Emails/onboard.htm.twig
                'Emails/profile.htm.twig', array('name' => $firstName)), 'text/html');
        $this->get('mailer')->send($message);

    }

    public function sendUnpaidWelcomeEmail($firstName, $emailAddress, $code)
    {
        $message = \Swift_Message::newInstance()->setSubject('PRISK Online Portal Profile')->setFrom('portal@prisk.or.ke', 'PRISK Online Portal Team')->setTo($emailAddress)->setBody($this->renderView(// app/Resources/views/Emails/onboard.htm.twig
                'Emails/unpaid.htm.twig', array('name' => $firstName, 'code' => $code)), 'text/html');
        $this->get('mailer')->send($message);
    }

    /**
     * @Route("/member/mpesa/success", name="mpesa-success")
     */
    public function mpesaPaymentSuccessAction()
    {
        //Receive Success Reply
        $customerNumber = $_POST['MSISDN'];
        $amount = $_POST['AMOUNT'];
        $mpesaStatus = $_POST['TRX_STATUS'];
        $trasactionDate = $_POST['M­PESA_TRX_DATE'];
        $mPesaTrasactionId = $_POST['M­PESA_TRX_ID'];
        $transactionReferenceId = $_POST['MERCHANT_TRANSACTION_ID'];
        $mpesaDescritpion = $_POST['DESCRIPTION'];
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository("AppBundle:Profile")->findOneBy(['idNumber' => $transactionReferenceId]);
        $user->setMpesaConfirmationCode($mPesaTrasactionId);
        $user->setMpesaDescription($mpesaDescritpion);
        $user->setMpesaPaymentDate($trasactionDate);
        $user->setMpesaStatus($mpesaStatus);
        $user->setIsPaid(true);
        $user->setMpesaNumber($customerNumber);
        $user->setMpesaAmount($amount);
        $em->persist($user);
        $em->flush();
    }

    /**
     * @Route("/member/mpesa/fail", name="mpesa-success")
     */
    public function mpesaPaymentFailureAction()
    {
        $customerNumber = $_POST['MSISDN'];
        $amount = $_POST['AMOUNT'];
        $mpesaStatus = $_POST['TRX_STATUS'];
        $trasactionDate = $_POST['M­PESA_TRX_DATE'];
        $mPesaTrasactionId = $_POST['M­PESA_TRX_ID'];
        $transactionReferenceId = $_POST['MERCHANT_TRANSACTION_ID'];
        $mpesaDescritpion = $_POST['DESCRIPTION'];
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository("AppBundle:Profile")->findOneBy(['idNumber' => $transactionReferenceId]);
        $user->setMpesaConfirmationCode($mPesaTrasactionId);
        $user->setMpesaDescription($mpesaDescritpion);
        $user->setMpesaPaymentDate($trasactionDate);
        $user->setMpesaStatus($mpesaStatus);
        $user->setIsPaid(false);
        $em->persist($user);
        $em->flush();
    }

    /**
     * @Route("/documents/{id}/add",name="add-document")
     */
    public function addDocumentsAction(Request $request, Profile $profile)
    {
        $profileDocs = $profile->getProfileDocuments();
        $docName[] = array();
        $docChoices[]=array();

        if ($profileDocs) {
            //Get all the docs and put their type in an array
            foreach ($profileDocs as $profileDoc) {
                $docName[] = $profileDoc->getDocumentName();
            }
            //Create Choices based on Missing documents
            if (!in_array('PASSPORT-PHOTO', $docName)) {
                $docChoices['Colour Passport-Size Photo'] = 'PASSPORT-PHOTO';
            }
            if (!in_array('ID-COPY', $docName)) {
                $docChoices['Copy of Valid National ID/Passport/Birth Certificate'] = 'ID-COPY';
            }
            if (!in_array('KRA-PIN', $docName)) {
                $docChoices['Copy of Kenya Revenue Authority ITAX Pin Certificate'] = 'KRA-PIN';
            }
            if (!in_array('NEXT-OF-KIN-ID', $docName)) {
                $docChoices['Copy of Valid National ID/Passport or Birth Certificate Next of Kin'] = 'NEXT-OF-KIN-ID';
            }
        }else {
                $docChoices['Colour Passport-Size Photo'] = 'PASSPORT-PHOTO';
                $docChoices['Copy of Valid National ID/Passport/Birth Certificate'] = 'ID-COPY';
                $docChoices['Copy of Kenya Revenue Authority ITAX Pin Certificate'] = 'KRA-PIN';
                $docChoices['Copy of Valid National ID/Passport or Birth Certificate Next of Kin'] = 'NEXT-OF-KIN-ID';

        }
        $em = $this->getDoctrine()->getManager();

        $document = new Documents();
        $document->setWhichProfile($profile);

        $form = $this->createForm(DocumentsFormType::class, $document,['docChoices'=>$docChoices]);

        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            $document = $form->getData();

            $profileId= $request->request->get('_pxc');

            $profile = $em->getRepository("AppBundle:Profile")
                ->findOneBy([
                    'id'=>$profileId
                ]);

            $em->persist($document);
            $em->flush();

            return $this->redirectToRoute("add-document",array('id' => $profile->getId(),'done'=>'success'));


        }
        return $this->render(':profile/documents:add.htm.twig',
            [
                'form' => $form->createView(),
                'profile' => $profile,
                'success' =>''
            ]
        );

    }

    /**
     * @Route("documents/added",name="document-added")
     */
    public function documentAddedAction(Request $request)
    {
        return $this->render(':profile/documents:added.htm.twig');
    }

    public function documentExists($documentName, Profile $profile)
    {
        $em = $this->getDoctrine()->getManager();
        $document = $em->getRepository("AppBundle:Documents")->findOneBy(['documentName' => $documentName, 'whichProfile' => $profile]);
        if ($document) {
            return true;
        } else {
            return false;
        }
    }
}
