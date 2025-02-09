<?php

namespace App\Model\BusinessLogic;

use Cake\Mailer\Mailer;
use Cake\Log\Log;

class SendEmail
{
    public function sendConfirmationEmail($album, $artists, $actionType)
    {
        $mailer = new Mailer('default');

        try {
            $mailer->setTo('fernando.ogihara@gmail.com')
                ->setSubject('Album ' . ucfirst($actionType) . ' Successfully')
                ->setEmailFormat('html')
                ->setFrom(['myalbumsapp@cake.com' => 'Fernando'])
                ->setViewVars([
                    'album' => $album,
                    'artists' => $artists,
                    'actionType' => $actionType
                ])
                ->viewBuilder()
                ->setTemplate('notification');

            $mailer->send(); // try to send email
        } catch (\Exception $e) {
            // register the email error
            Log::error('Erro ao enviar e-mail: ' . $e->getMessage());

            // validate errors
            if ($album->getErrors()) {
                Log::error('Errors validating albums: ' . json_encode($album->getErrors()));
            } else {
                Log::error('No validation errors in the album.');
            }
        }
    }
}
