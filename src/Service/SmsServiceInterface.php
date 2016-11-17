<?php

namespace Devim\Provider\MttServiceProvider\Service;

/**
 * Interface SmsSenderInterface.
 */
interface SmsServiceInterface
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
    public function send(string $to, string $message, string $shortCode = null);

    /**
     * @param string $transactionId
     *
     * @return int
     */
    public function check(string $transactionId);
}
