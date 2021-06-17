<?php

namespace App;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{

    static $PHPMailer;

    /**
     * 
     */
    function __construct(...$args)
    {
        $this->mailer = new PHPMailer(true);
        $this->mailer->isSMTP();
        $this->mailer->Host = $args['Host'] ?? null;               //Adresse IP ou DNS du serveur SMTP
        $this->mailer->Port = $args['Port'] ?? null;                          //Port TCP du serveur SMTP
        if (isset($args['Auth'])) {
            $args = $args['Auth'];
            $this->mailer->SMTPAuth = true;                                                        //Utiliser l'identification
            // $this->mailer->SMTPSecure = $args['SMTPSecure'];     //Protocole de sécurisation des échanges avec le SMTP
            $this->mailer->Username   = $args['Username'];                   //Adresse email à utiliser
            $this->mailer->Password   = $args['Password'];                        //Mot de passe de l'adresse email à utiliser
        }
    }

    /**
     * 
     */
    static function getMailer(...$args)
    {
        if (null == self::$PHPMailer) {
            self::$PHPMailer = new self(...$args);
        }
        return self::$PHPMailer;
    }

    /**
     * 
     */
    function send(Mail $mail)
    {
        if (null != self::$PHPMailer) {
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
