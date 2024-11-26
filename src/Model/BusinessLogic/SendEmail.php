<?php 

namespace App\Model\BusinessLogic;

use Cake\Mailer\Mailer;
use Cake\Log\Log;

class SendEmail
{
    public function sendConfirmationEmail($album, $artists, $actionType)
    {
        // Criação do objeto Mailer
        $mailer = new Mailer('default');  // Usando o perfil de e-mail configurado em app.php

        // Definindo o destinatário, assunto, e outras configurações
        $mailer->setTo('fernando.ogihara@gmail.com')  // Endereço do destinatário
            ->setSubject('Album ' . ucfirst($actionType) . ' Successfully')  // Assunto do e-mail
            ->setEmailFormat('html')  // Formato do e-mail (html ou text)
            ->setFrom(['myalbumsapp@cake.com' => 'Fernando'])  // Endereço e nome do remetente
            ->setViewVars([
                'album' => $album,  // Passando dados do álbum para o template
                'artists' => $artists,
                'actionType' => $actionType  // Passando o tipo de ação (ex: "Edit", "Delete")
            ])
            ->viewBuilder() // Necessário para configurar o template
                ->setTemplate('notification'); // Definindo o template correto

        // Envio do e-mail com a mensagem personalizada baseada no tipo de ação
        try {
            $mailer->send();
        } catch (\Exception $e) {
            $errors = $album->errors(); // Obtém os erros de validação
            Log::error('Erro ao enviar e-mail: ' . $errors);
        }
    }

}