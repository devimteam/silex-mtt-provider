<?php

namespace Devim\Provider\SmsProvider;

use Devim\Provider\SmsProvider\Sender\MttSmsSender;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class SmsProvider.
 */
class SmsProvider implements ServiceProviderInterface
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
        $container['mtt.short_code'] = '';

        $container['mtt.sender'] = function () use ($container) {
            return new MttSmsSender($container['mtt.login'], $container['mtt.password'], $container['mtt.short_code']);
        };
    }
}
