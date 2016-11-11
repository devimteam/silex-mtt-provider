<?php

namespace Devim\Provider\MttServiceProvider\Exception;

class SmsErrorException extends \Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}