<?php

namespace Devim\Provider\MttServiceProvider\Sender\Exception;

class SmsErrorException extends \RuntimeException
{
    /**
     * SmsNoCodeException constructor.
     *
     * @param string $type
     * @param string $error
     */
    public function __construct(string $type, string $error)
    {
        parent::__construct(sprintf('"%s" SMS service answer error "%s"', $type, $error));
    }
}
