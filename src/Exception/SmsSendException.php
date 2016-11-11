<?php

namespace Devim\Provider\MttServiceProvider\Exception;

class SmsSendException extends \Exception
{
    public function __construct($status)
    {
        parent::__construct(sprintf('Error. SMS service answered with status "%s"', $status));
    }
}