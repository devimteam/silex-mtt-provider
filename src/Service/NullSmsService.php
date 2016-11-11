<?php

namespace Devim\Provider\MttServiceProvider\Service;

/**
 * Class NullSmsSender.
 */
class NullSmsService implements SmsServiceInterface
{
    /**
     * Send SMS.
     *
     * @param string $to
     * @param string $message
     * @param string $shortCode
     *
     * @return string
     */
    public function send(string $to, string $message, string $shortCode) : string
    {
        return '1';
    }

    /**
     * @param string $transactionId
     * @param string|null $phone
     *
     * @return int
     */
    public function check(string $transactionId, string $phone = null) : int
    {
        return 1;
    }
}
