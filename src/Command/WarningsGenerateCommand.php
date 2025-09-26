<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface; 

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use App\DataFixtures\AppBudgetCheckWarnings;
use App\DataFixtures\AppInvoiceCheckWarnings;
use App\DataFixtures\AppContractorCheckWarnings; 
 

#[AsCommand(
    name: 'app:warnings:generate',
    description: 'Add a short description for your command',
)]
class WarningsGenerateCommand extends Command
{
 
    private $objectManager;

    // Wstrzyknięcie ObjectManager
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->objectManager = $entityManager;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output ): int
    {
        $io = new SymfonyStyle($input, $output);
 
        $output->writeln('Loading Budget Warning ...');
        $fixtures = new AppBudgetCheckWarnings();
        $fixtures->load($this->objectManager);
 
        $output->writeln('Loading Invoice Warning ...');
        $fixtures = new AppInvoiceCheckWarnings();
        $fixtures->load($this->objectManager);        
 
        $output->writeln('Loading Contractor Warning ...');
        $fixtures = new AppContractorCheckWarnings();
        $fixtures->load($this->objectManager);   

        return Command::SUCCESS;
    }
}
