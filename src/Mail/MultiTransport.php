<?php

namespace FoskyM\MultiMailer\Mail;

use Swift_Mime_SimpleMessage;
use Swift_SmtpTransport;
use Illuminate\Mail\Transport\Transport;
use FoskyM\MultiMailer\Model\MultiMailer;

class MultiTransport extends Swift_SmtpTransport
{
    public function isStarted()
    {
        // Always return true to prevent SwiftMailer from starting the transport automatically before sending
        return true;
    }
    public function send(Swift_Mime_SimpleMessage $message, &$failedRecipients = null)
    {
        $multiMailerFallback = MultiMailer::where('mail_suffix', '*')->first();
        $multiMailers = MultiMailer::where('mail_suffix', '<>', '*')->get();

        $mailers = [];

        if ($multiMailerFallback) {
            $mailers['fallback'] = [
                'mailer' => $multiMailerFallback,
                'email' => []
            ];
        }

        foreach ($multiMailers as $multiMailer) {
            $mailers[$multiMailer->mail_suffix] = [
                'mailer' => $multiMailer,
                'email' => []
            ];
        }

        $emails = array_keys($message->getTo());
        foreach ($emails as $email) {
            $email_suffix = trim(explode('@', $email)[1]) ?? '';
            $emails = array_diff($emails, [$email]);
            try {
                $multiMailer = $multiMailers->where('mail_suffix', $email_suffix)->firstOrFail();
                $mailers[$email_suffix]['email'][] = $email;
            } catch (\Exception $e) {
                $mailers['fallback']['email'][] = $email;
            }
        }

        $sent = 0;

        foreach ($mailers as $mailer) {
            if (empty($mailer['email'])) {
                continue;
            }

            $this->setHost($mailer['mailer']->mail_host);
            $this->setPort($mailer['mailer']->mail_port);
            $this->setEncryption($mailer['mailer']->mail_encryption);
            $this->setUsername($mailer['mailer']->mail_username);
            $this->setPassword($mailer['mailer']->mail_password);
            $message->setTo($mailer['email']);
            $this->start();
            $sent += parent::send($message, $failedRecipients);
            $this->stop();
        }

        return $sent;
    }
}
