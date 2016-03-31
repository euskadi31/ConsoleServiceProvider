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

use Symfony\Component\Console\Application as BaseApplication;
use Silex\Application as SilexApplication;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Application
 *
 * @author Axel Etcheverry <axel@etcheverry.biz>
 */
class Application extends BaseApplication
{
    /**
     * @var \Silex\Application
     */
    protected $container;

    /**
     * @return \Silex\Application
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param \Silex\SilexApplication $container
     * @param string                  $name
     * @param string                  $version
     */
    public function __construct(SilexApplication $container, $name = 'UNKNOWN', $version = 'UNKNOWN')
    {
        $env = 'dev';

        if (isset($container['environment'])) {
            $env = $container['environment'];
        }

        $this->container = $container;

        parent::__construct($name, $version);

        $this->getDefinition()->addOption(new InputOption('--env', '-e', InputOption::VALUE_REQUIRED, 'The Environment name.', $env));
    }

    /**
     * {@inheritdoc}
     *
     * @see \Symfony\Component\Console\Application::run()
     */
    public function run(InputInterface $input = null, OutputInterface $output = null)
    {
        $this->setAutoExit(false);
        $this->getContainer()->boot();
        $this->getContainer()->flush();
        $exitCode = parent::run($input, $output);
        $this->getContainer()->terminate(new Request(), new Response());

        return $exitCode;
    }
}
