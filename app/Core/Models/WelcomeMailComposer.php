<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model;

use CodeZero\Mailer\MailComposer;

class WelcomeMailComposer extends MailComposer {

    /**
     * Compose a welcome mail.
     *
     * @param string $email
     * @param string $firstname
     *
     * @return \CodeZero\Mailer\Mail
     */
    public function compose($email, $firstname)
    {
        $toEmail = $email;
        $toName = $firstname;
        $subject = 'Welcome!';
        $view = 'emails.welcome';
        $data = ['name' => $firstname];
        $options = null;

        return $this->getMail($toEmail, $toName, $subject, $view, $data, $options);
    }

}