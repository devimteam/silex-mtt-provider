<?php

namespace Devim\Provider\MttServiceProvider\Sender;

/**
 * Class NullSmsSender.
 */
class NullSmsSender implements SmsSenderInterface
{
    /**
     * Send SMS.
     *
     * @param string $to
     * @param string $message
     * @param string $shortCode
     *
     * @return void
     */
    public function send(string $to, string $message, string $shortCode)
    {
        return;
    }
}
