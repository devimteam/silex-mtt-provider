<?php

namespace Devim\Provider\MttServiceProvider\Sender;

use Devim\Provider\MttServiceProvider\Sender\Exception\SmsErrorException;
use Devim\Provider\MttServiceProvider\Sender\Exception\SmsSendException;

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
     * MttSmsSender constructor.
     *
     * @param string $login
     * @param string $password
     */
    public function __construct(string $login, string $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    /**
     * Send SMS.
     *
     * @param string $to
     * @param string $message
     * @param string $shortCode
     *
     * @return mixed
     *
     * @throws \Devim\Provider\MttServiceProvider\Sender\Exception\SmsErrorException
     * @throws \Devim\Provider\MttServiceProvider\Sender\Exception\SmsSendException
     */
    public function send(string $to, string $message, string $shortCode)
    {
        $url = self::SMS_POOL_URL . '?' . $this->buildQuery($to, $message, $shortCode);

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
     * @param string $shortCode
     *
     * @return string
     */
    final private function buildQuery(string $to, string $message, string $shortCode) : string
    {
        return http_build_query([
            'login' => $this->login,
            'password' => $this->password,
            'msisdn' => $to,
            'text' => $message,
            'shortcode' => $shortCode,
            'operation' => 'send',
        ]);
    }
}
