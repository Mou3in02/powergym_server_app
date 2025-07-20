<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:generate-user-admin',
    description: 'Generate new user with admin role',
)]
class GenerateUserAdminCommand extends Command
{
    public function __construct(
        private readonly UserPasswordHasherInterface $hasher,
        private readonly EntityManagerInterface      $em
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addOption('username', 'u', InputOption::VALUE_REQUIRED, 'Username of created user')
            ->addOption('password', 'p', InputOption::VALUE_REQUIRED, 'Password of created user');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $username = $input->getOption('username');
        $password = $input->getOption('password');

        if (empty($username)) {
            $io->error('Username cannot be empty !');
            return Command::FAILURE;
        }
        if (!strlen($password)) {
            $io->error('Password cannot be empty !');
            return Command::FAILURE;
        }
        $isUsernameExist = $this->em->getRepository(User::class)->count(['username' => $username]);
        if ($isUsernameExist) {
            $io->error('Username already exist create new one !');
            return Command::FAILURE;
        }

        $newUser = new User();
        $newUser->setUsername($username)
            ->setPassword($this->hasher->hashPassword($newUser, $password))
            ->setRoles([User::ROLE_ADMIN])
            ->setCreatedAt(new \DateTime())
            ->setIsDeleted(false);

        $this->em->persist($newUser);
        $this->em->flush();

        $io->success('New user created successfully !');
        $io->info('Username: ' . $username . ', Password: ' . $password);

        return Command::SUCCESS;
    }
}
