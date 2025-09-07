<?php

namespace App\Command\dev;

use App\Entity\AppJwtToken;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app-dev:generate-user-token',
    description: 'Generate new user jwt token',
)]
class GenerateUserTokenCommand extends Command
{
    public function __construct(
        private readonly UserPasswordHasherInterface $hasher,
        private readonly EntityManagerInterface      $em,
        private readonly JWTTokenManagerInterface    $jwtTokenManager
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
        $user = $this->em->getRepository(User::class)->findOneBy(['username' => $username, 'isDeleted' => false]);
        if (!$user) {
            $io->error('User not exist !');
            return Command::FAILURE;
        }
        $isPasswordValid = $this->hasher->isPasswordValid($user, $password);
        if (!$isPasswordValid) {
            $io->error('Password not valid !');
            return Command::FAILURE;
        }
        // Generate JWT TOKEN
        $token = $this->jwtTokenManager->create($user);

        $appJwtToken = (new AppJwtToken())
            ->setToken($token)
            ->setUser($user)
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime())
            ->setIsDeleted(false)
            ->setDeletedAt(null);
        $this->em->persist($appJwtToken);
        $this->em->flush();

        $io->text('Token : ' . PHP_EOL . $token);
        $io->success('New JWT token created successfully !');

        return Command::SUCCESS;
    }
}