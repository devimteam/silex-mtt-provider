<?php

namespace Devim\Provider\MttServiceProvider\Service;

use Devim\Provider\MttServiceProvider\SmsRequestService;
use Devim\Provider\MttServiceProvider\Helper\ResponseFilter;

class DoveSmsService implements SmsServiceInterface
{
    const OPERATION_SEND = 'send';
    const OPERATION_STATUS = 'status';

    /**
     * @var string
     */
    private $url;
    /**
     * @var BuilderParams
     */
    private $builderParams;

    /**
     * MttService constructor.
     *
     * @param BuilderParams $builderParams
     * @param string $url
     */
    public function __construct(BuilderParams $builderParams, string $url)
    {
        $this->url = $url;
        $this->builderParams = $builderParams;
    }

    /**
     * @param string $phone
     * @param string $text
     * @param string|null $shortCode
     *
     * @return string
     * @throws \Devim\Provider\MttServiceProvider\Exception\SmsErrorException
     * @throws \Devim\Provider\MttServiceProvider\Exception\SmsSendException
     */
    public function send(string $phone, string $text, string $shortCode = null) : string
    {
        if ($shortCode === null) {
            $shortCode = $this->builderParams->getParam('shortcode');
        }
        $this->builderParams->setParams([
            'msisdn' => $phone,
            'text' => $text,
            'shortcode' => $shortCode,
            'operation' => self::OPERATION_SEND
        ]);

        return ResponseFilter::filter(SmsRequestService::process($this->builderParams->getQueryParams(), $this->url));
    }

    /**
     * @param string $transactionId
     *
     * @return int
     * @throws \Devim\Provider\MttServiceProvider\Exception\SmsErrorException
     * @throws \Devim\Provider\MttServiceProvider\Exception\SmsSendException
     */
    public function check(string $transactionId) : int
    {
        $this->builderParams->setParams([
            'id' => $transactionId,
            'operation' => self::OPERATION_STATUS
        ]);

        return ResponseFilter::filter(SmsRequestService::process($this->builderParams->getQueryParams(), $this->url));
    }

    /**
     * @return array
     */
    public function receive()
    {
        return [];
    }
}