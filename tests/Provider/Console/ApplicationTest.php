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

use Euskadi31\Silex\Provider\Console;
use Silex;

class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass()
    {
        require_once __DIR__ . '/../../_files/TestCommand.php';
    }

    public function testConstructor()
    {
        $app = new Silex\Application();

        $app['environment'] = 'prod';

        $console = new Console\Application($app, 'Test', '1.2.3');

        $this->assertEquals($app, $console->getContainer());
        $this->assertEquals('Test', $console->getName());
        $this->assertEquals('1.2.3', $console->getVersion());
    }

    public function testRun()
    {
        $_SERVER['argv'] = ['cli.php', '--env=prod', 'foo:bar1'];

        $app = new Silex\Application();

        $console = new Console\Application($app, 'Test', '1.2.3');
        $console->add($command = new \Foo1Command());

        ob_start();
        $console->run();
        ob_end_clean();

        $this->assertInstanceOf('Symfony\Component\Console\Input\ArgvInput', $command->input, '->run() creates an ArgvInput by default if none is given');
        $this->assertInstanceOf('Symfony\Component\Console\Output\ConsoleOutput', $command->output, '->run() creates a ConsoleOutput by default if none is given');

    }
}
