<?php

namespace These\Notifications;

interface SendToUser
{
    public function send($view, $data = [], $mailingList, $attachement = null);
}
