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
     *
     * @return void
     */
    public function send(string $to, string $message)
    {
        return;
    }
}
