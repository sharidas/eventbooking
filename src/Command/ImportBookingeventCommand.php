<?php

namespace App\Command;

use App\Entity\EventBooking;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ImportBookingeventCommand extends Command
{
    private $entityManager;
    protected static $defaultName = 'app:import-bookingevent';

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Import booking event json data to the DB')
            ->addArgument('path', InputArgument::OPTIONAL, 'Absolute path of the json file.')
            //->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    private function dumpToDB(array $jsonData) {
        //$entityManager = $this->container->get('doctrine')->getManager();

        foreach ($jsonData as $datum) {
            if (isset($datum['participation_id']) && isset($datum['employee_name']) && isset($datum['employee_mail']) &&
                isset($datum['event_id']) && isset($datum['event_name']) && isset($datum['participation_fee']) &&
                isset($datum['event_date']) && isset($datum['version'])) {
                $eventBooking = new EventBooking();
                $eventBooking->setParticipationId($datum['participation_id']);
                $eventBooking->setEmployeeName($datum['employee_name']);
                $eventBooking->setEmployeeMail($datum['employee_mail']);
                $eventBooking->setEventId($datum['event_id']);
                $eventBooking->setEventName($datum['event_name']);
                $eventBooking->setParticipationFee($datum['participation_fee']);

                $date = \DateTime::createFromFormat('Y-m-d H:i:s', $datum['event_date']);
                $eventBooking->setEventDate($date);


                $eventBooking->setVersion($datum['version']);
                //$entityManager->persist($eventBooking);
                $this->entityManager->persist($eventBooking);
            }
        }
        $this->entityManager->flush();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $path = $input->getArgument('path');

        if ($path) {
            if (file_exists($path)) {
                //$io->note(sprintf('You passed an argument: %s', $path));
                $data = file_get_contents($path);
                $jsonData = json_decode($data, true);
                $this->dumpToDB($jsonData);
            }
        }

        /*if ($input->getOption('option1')) {
            // ...
        }*/

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return 0;
    }
}
