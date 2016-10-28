<?php

namespace Devim\Provider\MttServiceProvider\Sender;

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
     * @param string $shortCode
     *
     * @return mixed
     */
    public function send(string $to, string $message, string $shortCode);
}
