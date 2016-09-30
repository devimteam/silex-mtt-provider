<?php

namespace Devimteam\Provider\SmsProvider\Sender;

use Devimteam\Provider\SmsProvider\Sender\Exception\SmsErrorException;
use Devimteam\Provider\SmsProvider\Sender\Exception\SmsSendException;

/**
 * Class MttSmsSender.
 */
class MttSmsSender implements SmsSenderInterface
{
    const SMS_POOL_URL = 'https://httpsms.mtt.ru/send';

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
    private $shortCode;

    /**
     * MttSmsSender constructor.
     *
     * @param string $login
     * @param string $password
     * @param string $shortCode
     */
    public function __construct(string $login, string $password, string $shortCode)
    {
        $this->login = $login;
        $this->password = $password;
        $this->shortCode = $shortCode;
    }

    /**
     * Send SMS.
     *
     * @param string $to
     * @param string $message
     *
     * @return mixed
     *
     * @throws \Devimteam\Provider\SmsProvider\Sender\Exception\SmsErrorException
     * @throws \Devimteam\Provider\SmsProvider\Sender\Exception\SmsSendException
     */
    public function send(string $to, string $message)
    {
        $url = self::SMS_POOL_URL . '?' . $this->buildQuery($to, $message);

        $request = curl_init($url);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($request);
        $status = (int)curl_getinfo($request, CURLINFO_HTTP_CODE);
        curl_close($request);

        if ($status !== 200) {
            throw new SmsSendException(get_class($this), $status);
        }
        if (!preg_match('/^\d+$/', $response)) {
            throw new SmsErrorException(get_class($this), $response);
        }

        return $response;
    }

    /**
     * @param string $to
     * @param string $message
     *
     * @return string
     */
    final private function buildQuery(string $to, string $message) : string
    {
        return http_build_query([
            'login' => $this->login,
            'password' => $this->password,
            'msisdn' => $to,
            'text' => $message,
            'shortcode' => $this->shortCode,
            'operation' => 'send',
        ]);
    }
}
