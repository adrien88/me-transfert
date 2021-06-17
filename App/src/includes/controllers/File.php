<?php

namespace App\controllers;

use App\Mail;
use App\Mailer;
use App\models\File as ModelsFile;
use App\Router\Route;
use Exception;
use finfo;

#[Route('file/')]
class File
{
    const OK = [200, 'Files are transfered.'];
    const ERROR_NOEMAIL = [400, 'There is no file.'];
    const ERROR_BADEMAIL = [401, 'Email is bad formated.'];
    const ERROR_NOFILE = [402, 'There is no file.'];
    const ERROR_TOOMANYFILE = [403, 'There are too many file. %s files max awaited.'];
    const ERROR_FILETOHEAVY = [404, 'File is too heavy.'];
    const ERROR_FILEBADTYPE = [405, 'File bad type. Format %s awaited.'];

    #[Route('')]
    function default($slug = null)
    {
        // var_dump('ok');
        // $this->get($slug);
    }

    /**
     * Return JSON data about file
     */
    #[Route('get/')]
    function get(string $slug = null)
    {
        $file = new ModelsFile($slug);
        if ($file->exists()) {
            header('Content-Type: ' . $file->type);
            $file->readfile();
            exit;
        } else {
            http_response_code(404);
            echo 'This file not exists.';
            exit;
        }
        // var_dump('ok');
    }

    /**
     * 
     */
    #[Route('send/')]
    function send(string $slug = null)
    {
        $handle = new ModelsFile($slug);
        foreach ($_FILES as $file) {
            $handle->moveUploaded($file);
        }

        $list = $handle->list();

        if (1 >= count($list)) {
            if (!isset($_POST['destemail']))
                $this->response(self::ERROR_NOEMAIL);

            $mail = new Mail();
            $dests = (is_array($_POST['destemail'])) ? $_POST['destemail'] : [$_POST['destemail']];
            foreach ($dests as $email) {
                if (!$mail->setEmail($email))
                    $this->response(self::ERROR_BADEMAIL);

                $mail->subject = 'On vous envoie un fichier !';
                $mail->message = 'Lien pour télécharger le⋅s fichier⋅s.<ul>';
                foreach ($list as $file)
                    $mail->message .= '<li><a href="' . $file->path . $file->filename . '">' . $file->name . '</a><li>';
                $mail->message = '</ul>';
            }
            $mailer = Mailer::getMailer();
            $mailer->send($mail);
        }

        $this->response(self::OK);
    }

    /**
     * 
     */
    #[Route('delete/')]
    function delete(string $slug = null)
    {
        $handle = new ModelsFile($slug);
        if ($handle->exist()) {
            $handle->unlink();
            $this->response([200, 'Le fichier a été supprimé.']);
        } else {
            $this->response([400, 'Le fichier n\'existe pas.']);
        }
    }

    /**
     *  Send JS reponse
     */
    function response(array $const = [])
    {
        header('Content-type: application/json');
        echo json_encode([
            'status' => $const[0],
            'msgg' => $const[1]
        ]);
        die;
    }
}
