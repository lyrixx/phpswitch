<?php
namespace jubianchi\PhpSwitch\Console\Command;

use Symfony\Component\Console\Command\Command as BaseCommand;
use Symfony\Component\Console\Formatter\OutputFormatter;
use Symfony\Component\Console\Output\OutputInterface;
use Monolog\Logger;

abstract class Command extends BaseCommand
{
    const NAME = 'command';
    const DESC = '';

    const INDENT = '    ';

    /**
     * @param string $name
     */
    public function __construct($name = null)
    {
        parent::__construct($name ?: static::NAME);

        $this->setDescription(static::DESC);
    }

    /**
     * @return \jubianchi\PhpSwitch\Config\Configuration
     */
    public function getConfiguration()
    {
        return $this->getApplication()->getConfiguration();
    }

    /**
     * @return \Monolog\Logger
     */
    public function getLogger()
    {
        return $this->getApplication()->getLogger();
    }

    /**
     * @param string[]|string                                   $messages
     * @param int                                               $level
     *
     * @return \jubianchi\PhpSwitch\Console\Command\Command
     */
    public function log($messages, $level = Logger::INFO)
    {
        if (false === is_array($messages)) {
            $messages = array($messages);
        }

        foreach ($messages as $message) {
            $this->getLogger()->addRecord($level, $message);
        }

        return $this;
    }

    /**
     * @return \jubianchi\PhpSwitch\Console\Application
     */
    public function getApplication()
    {
        return parent::getApplication();
    }
}
