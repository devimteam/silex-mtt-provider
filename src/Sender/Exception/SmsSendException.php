<?php

namespace Devim\Provider\SmsProvider\Sender\Exception;

/**
 * Class SmsSendException.
 */
class SmsSendException extends \RuntimeException
{
    /**
     * SmsSendException constructor.
     *
     * @param string $type
     * @param string $status
     */
    public function __construct(string $type, string $status)
    {
        parent::__construct(sprintf('"%s" SMS service answered with status "%s"', $type, $status));
    }
}
