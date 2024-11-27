<?php

namespace App\Model\BusinessLogic;

use Cake\Mailer\Mailer;
use Cake\Log\Log;

class SendEmail
{
    public function sendConfirmationEmail($album, $artists, $actionType)
    {
        // Create the Mailer object
        $mailer = new Mailer('default');  // Using the email profile configured in app.php

        // Set the recipient, subject, and other configurations
        $mailer->setTo('fernando.ogihara@gmail.com')  // Recipient's email address
            ->setSubject('Album ' . ucfirst($actionType) . ' Successfully')  // Email subject (e.g., "Album Added Successfully")
            ->setEmailFormat('html')  // Email format (either 'html' or 'text')
            ->setFrom(['myalbumsapp@cake.com' => 'Fernando'])  // Sender's email address and name
            ->setViewVars([
                'album' => $album,  // Passing album data to the email template
                'artists' => $artists,  // Passing the artists list to the email template
                'actionType' => $actionType  // Passing the action type (e.g., "Edit", "Delete")
            ])
            ->viewBuilder() // Necessary to configure the template
                ->setTemplate('notification'); // Setting the correct email template

        // Attempt to send the email with the personalized message based on the action type
        try {
            $mailer->send();  // Send the email
        } catch (\Exception $e) {
            // If an error occurs during email sending, log it
            $errors = $album->errors();  // Retrieve any validation errors from the album data
            Log::error('Error sending email: ' . print_r($errors, true));  // Log the error
        }
    }
}
