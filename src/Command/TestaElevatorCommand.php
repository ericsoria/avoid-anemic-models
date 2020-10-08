<?php

namespace App\Command;

use App\ElevatorSimulate;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestaElevatorCommand extends Command
{
    protected static $defaultName = 'testa:elevator-simulate';
    private ElevatorSimulate $elevatorSimulate;

    public function __construct(ElevatorSimulate $elevatorSimulate)
    {
        parent::__construct(null);
        $this->elevatorSimulate = $elevatorSimulate;
    }

    protected function configure()
    {
        $this
            ->setDescription('Simulate elevator position on a specific schedule')
            ->setHelp('This command prints the position of an elevator every minute of its working schedule')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->elevatorSimulate->__invoke();
        return Command::SUCCESS;
    }
}
