<?php

namespace Devim\Provider\SmsProvider\Sender;

/**
 * Interface SmsSenderInterface.
 */
interface SmsSenderInterface
{
    /**
     * Send SMS.
     *
     * @param string $to
     * @param string $message
     *
     * @return mixed
     */
    public function send(string $to, string $message);
}
