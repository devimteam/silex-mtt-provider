<?php

namespace Devim\Provider\MttServiceProvider\Service;

use Devim\Provider\MttServiceProvider\SmsRequestService;
use Devim\Provider\MttServiceProvider\Helper\MttResponseFilter;

class MttSmsService implements SmsServiceInterface
{
    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $defaultShortCode;

    /**
     * MttService constructor.
     *
     * @param string $login
     * @param string $password
     * @param string $url
     * @param string $defaultShortCode
     */
    public function __construct(string $login, string $password, string $url, string $defaultShortCode)
    {
        $this->login = $login;
        $this->password = $password;
        $this->url = $url;
        $this->defaultShortCode = $defaultShortCode;
    }

    /**
     * @param string $phone
     * @param string $text
     * @param string|null $shortCode
     *
     * @return string
     */
    public function send(string $phone, string $text, string $shortCode = null) : string
    {
        if ($shortCode === null) {
            $shortCode = $this->defaultShortCode;
        }

        $data = [
            'msisdn' => $phone,
            'text' => $text,
            'shortcode' => $shortCode,
            'operation' => 'send'
        ];
        $this->applyCredentialsAndBuildParams($data);

        return MttResponseFilter::filter(SmsRequestService::process($data, $this->url));
    }

    /**
     * @param string $transactionId
     *
     * @return int
     */
    public function check(string $transactionId) : int
    {
        $data = [
            'id' => $transactionId,
            'operation' => 'status'
        ];
        $this->applyCredentialsAndBuildParams($data);

        return MttResponseFilter::filter(SmsRequestService::process($data, $this->url));
    }

    /**
     * @return array
     */
    public function receive()
    {
        return [];
    }

    /**
     * @param $data
     */
    private function applyCredentialsAndBuildParams(array &$data)
    {
        $data['login'] = $this->login;
        $data['password'] = $this->password;

        $data = http_build_query($data);
    }
}