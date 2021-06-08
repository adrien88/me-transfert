<?php

namespace App;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{

    static $mailer;

    /**
     * 
     */
    function __construct(...$args)
    {
        $this->mailer = new PHPMailer(true);
        $this->mailer->isSMTP();
        $this->mailer->Host = $args['Host'] ?? 'ssl0.ovh.net';               //Adresse IP ou DNS du serveur SMTP
        $this->mailer->Port = $args['port'] ?? 465;                          //Port TCP du serveur SMTP
        if (isset($args['Auth'])) {
            $args = $args['Auth'];
            $this->mailer->SMTPAuth = 1;                                                        //Utiliser l'identification
            $this->mailer->SMTPSecure = $args['SMTPSecure'] ?? PHPMailer::ENCRYPTION_SMTPS;     //Protocole de sécurisation des échanges avec le SMTP
            $this->mailer->Username   = $args['Username'] ?? 'login@ovh.net';                   //Adresse email à utiliser
            $this->mailer->Password   = $args['Password'] ?? 'password';                        //Mot de passe de l'adresse email à utiliser
        }
    }

    /**
     * 
     */
    static function getMailer(...$args): PHPMailer
    {
        if (null == self::$mailer) {
            self::$mailer = new self(...$args);
        }
        return self::$mailer;
    }

    /**
     * 
     */
    function send(Mail $mail)
    {
        if (null != self::$mailer) {
            $mailer = self::getMailer();
            $mailer->addAddress($mail->email, $mail->email_name);
            $mailer->isHTML($mail->isHtml);
            $mailer->Subject = $mail->subject;
            $mailer->Body = $mail->message;

            try {
                $mailer->smtpConnect();
                $mailer->send();
            } catch (Exception $e) {
                throw new Exception('Mailer don\'t work cause : ' . $e->getMessage(), 0, $e);
            }
        } else {
            throw new Exception('Mailer is not defined.');
        }
    }
}
