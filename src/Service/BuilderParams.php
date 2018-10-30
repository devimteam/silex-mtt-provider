<?php

namespace Devim\Provider\MttServiceProvider\Service;

class BuilderParams
{
    private $data = [];
    private $required = [];
    private $default = [];

    public function __construct(string $login, string $password, string $shortcode, string $source)
    {
        $this->required['login'] = $login;
        $this->required['password'] = $password;
        $this->required['source'] = $source;
        $this->default['shortcode'] = $shortcode;
    }

    public function setParams(array $data)
    {
        $this->data = $data;
    }

    public function getParam(string $key, $default = null)
    {
        return $this->data[$key] ?? $this->default{$key} ?? $default;
    }

    public function getQueryParams(): string
    {
        return http_build_query(array_merge($this->required, $this->data));
    }
}