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

use Euskadi31\Silex\Provider\ConsoleServiceProvider;
use Euskadi31\Silex\Provider\Console\ConsoleEvents;
use Silex\Application;

class ConsoleServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testRegisterWithoutOptions()
    {
        $app = new Application;

        $app->register(new ConsoleServiceProvider());

        $this->assertEquals('\Euskadi31\Silex\Provider\Console\Application', $app['console.class']);

        $this->assertTrue(isset($app['console.options']));
        $this->assertEquals([
            'name'      => 'Console',
            'version'   => null
        ], $app['console.options']);
    }

    public function testRegister()
    {
        $app = new Application;

        $app->register(new ConsoleServiceProvider(), [
            'console.options' => [
                'name'      => 'Test',
                'version'   => '1.2.3'
            ]
        ]);

        $this->assertTrue(isset($app['console.options']));
        $this->assertEquals([
            'name'      => 'Test',
            'version'   => '1.2.3'
        ], $app['console.options']);

        $this->assertInstanceOf('\Euskadi31\Silex\Provider\Console\Application', $app['console']);
    }

    public function testBoot()
    {
        $dispatcherMock = $this->getMock('Symfony\Component\EventDispatcher\EventDispatcherInterface');

        $dispatcherMock->expects($this->once())
            ->method('dispatch')
            ->with($this->equalTo(ConsoleEvents::INIT), $this->anything());

        $app = new Application;

        $app['dispatcher'] = function() use ($dispatcherMock) {
            return $dispatcherMock;
        };

        $app->register(new ConsoleServiceProvider(), [
            'console.options' => [
                'name'      => 'Test',
                'version'   => '1.2.3'
            ]
        ]);

        $app->boot();
    }
}
