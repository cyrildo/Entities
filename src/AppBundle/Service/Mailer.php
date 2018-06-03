<?php
/**
 * Created by PhpStorm.
 * User: gollum
 * Date: 03/06/18
 * Time: 18:17
 */

namespace AppBundle\Service;


use AppBundle\Entity\Reservation;
use Swift_Mailer;
use Twig_Environment;

class Mailer
{
    /**
     * @var
     */
    private $mailer;

    /**
     * @return mixed
     */
    public function getMailer()
    {
        return $this->mailer;
    }

    /**
     * @param mixed $mailer
     */
    public function setMailer($mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @return mixed
     */
    public function getTemplating()
    {
        return $this->templating;
    }

    /**
     * @param mixed $templating
     */
    public function setTemplating($templating)
    {
        $this->templating = $templating;
    }

    /**
     * @var
     */
    private $templating;

    /**
     * Mailer constructor.
     * @param \Swift_Mailer $mailer
     * @param \Twig_Environment $templating
     */
    public function __construct(Swift_Mailer $mailer, Twig_Environment $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    /**
     *
     */
        public function sendMail($destination, $subject, $body)
        {
        $message = (new \Swift_Message($subject))
            ->setFrom('xreservations@flyaround.com')
            ->setTo($destination)
            ->setBody($this->templating->render('email/email.html.twig'), ['body'=> $body, 'subject'=> $subject])
            ->setContentType('text/html');
        $this->mailer->send($message);
    }
}