<?php

namespace Acme;

use DMS\Service\Meetup\MeetupKeyAuthClient;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Lottery extends Command {

	private $meetupApiKey = 'meetupApiKey';

	public function configure()
	{
		$this->setName('Lottery')
			->setDescription('Grain PHP Storm licence to attender from Meetup.com')
			->addArgument('id', InputArgument::REQUIRED, 'Meetup ID.');
	}

	public function execute(InputInterface $input, OutputInterface $output)
	{
		$output->writeln('<info>Fetching all members...</info>');
		
		$meetupId = $input->getArgument('id');

		$client   = MeetupKeyAuthClient::factory(['key' => $this->meetupApiKey]);
		$response = $client->getRsvps(['event_id' => $meetupId]);
		$members  = [];

		foreach ($response as $responseItem) {
		    array_push($members, [
		        'id'   => $responseItem['member']['member_id'],
		        'name' => $responseItem['member']['name']
		    ]);
		}

		$table = new Table($output);

		$table->setHeaders(['id', 'name'])
			->setRows($members)
			->render();

		$output->writeln('<info>The winner is?</info>');
		$randomMemberKey = array_rand($members);

		$table->setHeaders(['id', 'name'])
			->setRows([$members[$randomMemberKey]])
			->render();
	}
}
