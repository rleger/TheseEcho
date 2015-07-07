<?php

namespace These\Notifications;

use App;
use Illuminate\Mail\Mailer;
use Illuminate\Config\Repository as Config;

/**
 * Class SendAdminMessageToUser.
 */
class SendAdminMessageToUser implements SendToUser
{
    /**
     * @var Mailer
     */
    protected $mail;

    /**
     * Construtor.
     *
     * @param Mailer $mail
     */
    public function __construct(Mailer $mail)
    {
        $this->mail = $mail;
    }

    /**
     * Send message.
     *
     * @param       $view
     * @param array $data
     * @param       $mailingList
     * @param null  $attachement
     *
     * @return bool
     */
    public function send($view, $data = [], $mailingList, $attachement = null)
    {
        $config = App::make(Config::class);

        $emailParams = $config->get('These.admin.email');

        // If the file size is bigger than 20 Mo do not attach the file
        if (is_null($attachement) || filesize($attachement) > 20000000) {
            $attachement = false;
        }

        $this->mail->queue($view, $data, function ($message) use ($mailingList, $attachement, $emailParams) {
            $message->from($emailParams['from'], $emailParams['name']);
            $message->subject('Administration de Thèse ALR');
            $message->to($mailingList);
            if ($attachement) {
                $message->attach($attachement);
            }
        });

        return true;
    }
}
