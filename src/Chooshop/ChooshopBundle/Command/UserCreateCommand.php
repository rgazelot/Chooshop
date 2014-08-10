<?php

namespace Chooshop\ChooshopBundle\Command;

use InvalidArgumentException;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand,
    Symfony\Component\Console\Input\InputArgument,
    Symfony\Component\Console\Input\InputInterface,
    Symfony\Component\Console\Input\InputOption,
    Symfony\Component\Console\Output\OutputInterface;

use Chooshop\ChooshopBundle\DTO\UserTransfer,
    Chooshop\ChooshopBundle\Entity\House,
    Chooshop\ChooshopBundle\Form\UserType;

class UserCreateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('chooshop:user:create')
            ->setDescription('Create an user')
            ->addArgument('house', InputArgument::REQUIRED, 'The house name')
            ->addArgument('email', InputArgument::REQUIRED, 'The user email')
            ->addArgument('firstname', InputArgument::REQUIRED, 'The user firstname')
            ->addArgument('lastname', InputArgument::REQUIRED, 'The user lastname')
            ->addOption('root', null, InputOption::VALUE_NONE, 'If set, the user will be root')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $userTransfer = new UserTransfer;

        $form = $this->getContainer()->get('form.factory')->create(new UserType, $userTransfer);
        $form->submit([
            'email'     => $input->getArgument('email'),
            'firstname' => $input->getArgument('firstname'),
            'lastname'  => $input->getArgument('lastname'),
            'role'      => true === $input->getOption('root') ? 'ROLE_ROOT' : 'ROLE_USER',
        ]);

        if (!$form->isValid()) {
            throw new InvalidArgumentException("Invalid form argument");
        }

        $house = $this->getContainer()->get('doctrine.orm.entity_manager')->getRepository('ChooshopBundle:House')->findOneByName($input->getArgument('house'));

        if (null === $house) {
            $house = new House($input->getArgument('house'));
        }

        $this->getContainer()->get('chooshop.user')->create($house, $userTransfer);
        $output->writeLn('User created');
    }
}
