<?php
/*********************************************************************************
 * Developed by Maxx Ng'ang'a
 * (C) 2017 Crysoft Dynamics Ltd
 * Karbon V 2.1
 * User: Maxx
 * Date: 6/14/2017
 * Time: 11:56 AM
 ********************************************************************************/

namespace AppBundle\Entity;

class Notifications
{
    private $firstName;
    private $lastName;
    private $code;
    private $emailAddress;

    function __construct($userFirstName,$emailAddress,$message,$template,$code=null)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('PRISK Online Portal Profile')
            ->setFrom('prisk@prisk.or.ke','PRISK Online Portal Team')
            ->setTo($emailAddress)
            ->setBody(
                $this->renderView(
                // app/Resources/views/Emails/onboard.htm.twig
                    'Emails/unpaid.htm.twig',
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