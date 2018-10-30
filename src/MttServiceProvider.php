<?php

namespace Devim\Provider\MttServiceProvider;

use Devim\Provider\MttServiceProvider\Service\BuilderParams;
use Devim\Provider\MttServiceProvider\Service\DoveSmsService;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class SmsProvider.
 */
class MttServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $container A container instance
     */
    public function register(Container $container)
    {
        $container['mtt.login'] = '';
        $container['mtt.password'] = '';
        $container['mtt.default_short_code'] = '';
        $container['mtt.url'] = '';
        $container['mtt.source'] = '';

        $container['sms.builder.params'] = function () use ($container) {
            return new BuilderParams($container['mtt.login'], $container['mtt.password'], $container['mtt.default_short_code'], $container['mtt.source']);
        };
        $container['sms.mtt'] = function () use ($container) {
            return new DoveSmsService($container['sms.builder.params'], $container['mtt.url']);
        };
    }
}
