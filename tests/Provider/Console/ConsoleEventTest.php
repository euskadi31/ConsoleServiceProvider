<?php
/*
 * This file is part of the ConsoleServiceProvider.
 *
 * (c) Axel Etcheverry <axel@etcheverry.biz>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Euskadi31\Silex\Provider\Console;

use Euskadi31\Silex\Provider\Console\ConsoleEvent;

class ConsoleEventTest extends \PHPUnit_Framework_TestCase
{
    public function testEvent()
    {
        $consoleMock = $this->getMockBuilder('\Euskadi31\Silex\Provider\Console\Application')
            ->disableOriginalConstructor()
            ->getMock();

        $event = new ConsoleEvent($consoleMock);

        $this->assertEquals($consoleMock, $event->getConsole());
        $this->assertEquals($consoleMock, $event->getApplication());
    }
}
