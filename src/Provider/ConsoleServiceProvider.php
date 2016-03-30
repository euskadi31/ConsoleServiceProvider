<?php
/*
 * This file is part of the ConsoleServiceProvider.
 *
 * (c) Axel Etcheverry <axel@etcheverry.biz>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Euskadi31\Silex\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Api\BootableProviderInterface;
use Silex\Application;

/**
 * Console integration for Silex.
 *
 * @author Axel Etcheverry <axel@etcheverry.biz>
 */
class ConsoleServiceProvider implements ServiceProviderInterface, BootableProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function register(Container $app)
    {
        $app['console.class'] = '\Euskadi31\Silex\Provider\Console\Application';

        $app['console.options'] = [
            'name'      => 'Console',
            'version'   => null
        ];

        $app['console'] = function($app) {
            $class = $app['console.class'];
            $console = new $class(
                $app,
                $app['console.options']['name'],
                $app['console.options']['version']
            );

            return $console;
        };
    }

    /**
     * {@inheritDoc}
     */
    public function boot(Application $app)
    {
        $app['dispatcher']->dispatch(
            Console\ConsoleEvents::INIT,
            new Console\ConsoleEvent($app['console'])
        );
    }
}
