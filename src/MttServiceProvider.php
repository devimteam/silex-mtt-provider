<?php

namespace Devim\Provider\MttServiceProvider;

use Devim\Provider\MttServiceProvider\Service\MttSmsService;
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
        $container['mtt.url'] = '';

        $container['sms.mtt'] = function () use ($container) {
            return new MttSmsService($container['mtt.login'], $container['mtt.password'], $container['mtt.url']);
        };
    }
}
