<?php

namespace App\Command\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateAdminCommand extends Command
{
    protected static $defaultName = 'app:admin:create';

    private $encoder;
    private $validator;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $encoder, ValidatorInterface $validator)
    {
        parent::__construct();

        $this->entityManager = $entityManager;
        $this->encoder = $encoder;
        $this->validator = $validator;
    }

    protected function configure()
    {
        $this
            ->setDescription('Permet de créer un Administrateur')
            ->addArgument('username', InputArgument::OPTIONAL, 'username')
            ->addArgument('email', InputArgument::OPTIONAL, 'email')
            ->addArgument('password', InputArgument::OPTIONAL, 'password')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $returnCode = 0;

        $username = $input->getArgument('username');
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');

        //Require Value
        if (null === $username || null === $email || null === $password) {
            $username = $io->ask('Entrez votre pseudo', 'admin');
            $email = $io->ask('Entrez votre adresse email', 'admin@example.com');
            $password = $io->ask('Entrez votre mot de passe', 'password');
        }

        $user = new User();

        $encoded = $this->encoder->encodePassword($user, $password);
        $user->setPassword($encoded);

        // Required value form User entity
        $user->setUsername($username);

        $user->setFirstname('Prénom');
        $user->setLastname('Nom');
        $user->setEmail($email);
        $user->addRole('ROLE_ADMIN');

        $user->setEnabled(true);
        $user->setLocked(false);

        $errors = $this->validator->validate($user);

        if (count($errors) > 0) {
            $returnCode = 1;

            $io->error($errors);
        } else {
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $io->success('Admin créé !');
        }

        return $returnCode;
    }
}
