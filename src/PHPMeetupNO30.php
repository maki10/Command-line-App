<?php

namespace Acme;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PHPMeetupNO30 extends Command {

	public function configure()
	{
		$this->setName('PHPMeetupNO30')
			->setDescription('Say Hello to given person on Serbian language.')
			->addArgument('name', InputArgument::REQUIRED, 'Your name.')
			->addOption('message', null, InputOption::VALUE_OPTIONAL, 'Override default message', 'Pozdrav sa meetup-a');
	}

	public function execute(InputInterface $input, OutputInterface $output)
	{
		$name = $input->getArgument('name');
		$message = $input->getOption('message');

		$output->writeln('<info>' .$message. ' ' . $name . '</info>');
	}
}
