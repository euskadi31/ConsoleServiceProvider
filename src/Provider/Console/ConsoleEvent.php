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

use Symfony\Component\EventDispatcher\Event;

/**
 * Console Event
 *
 * @author Axel Etcheverry <axel@etcheverry.biz>
 */
class ConsoleEvent extends Event
{
    /**
     * @var Application
     */
    protected $console;

    /**
     *
     * @param Application $console
     */
    public function __construct(Application $console)
    {
        $this->console = $console;
    }

    /**
     * @return Application
     */
    public function getConsole()
    {
        return $this->console;
    }

    /**
     * For Knp compatibility.
     *
     * @return Application
     */
    public function getApplication()
    {
        return $this->getConsole();
    }
}
