<?php

namespace KernelApiBundle\Command;

use SecureBundle\Entity\Account;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddAccountCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('rebl:add-account')
            ->setDescription('Creates a new user account')
            ->addArgument('type', InputArgument::REQUIRED, 'The type of the account');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $type = $input->getArgument('type');

        $em = $this->getContainer()->get('doctrine')->getManager();

        $account = new Account();
        $account->setType($type);

        $em->persist($account);
        $em->flush();
    }
}