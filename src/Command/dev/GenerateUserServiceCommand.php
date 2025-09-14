<?php

namespace App\Command\dev;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app-dev:generate-user-service',
    description: 'Generate new service user roles',
)]
class GenerateUserServiceCommand extends Command
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
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $users = $this->em->getRepository(User::class)->findBy(['isDeleted' => false]);
        $nbServiceUser = 0;
        foreach ($users as $user) {
            if (in_array(User::ROLE_SERVICE, $user->getRoles(), true)) {
                $nbServiceUser++;
            }
        }

        $newUser = new User();
        $newUser->setUsername('service_' . $nbServiceUser)
            ->setPassword($this->hasher->hashPassword($newUser, '1Twothree4Five%%' . $nbServiceUser))
            ->setRoles([User::ROLE_SERVICE])
            ->setCreatedAt(new \DateTime())
            ->setIsDeleted(false);

        $this->em->persist($newUser);
        $this->em->flush();

        $io->success('New service user created successfully !');

        return Command::SUCCESS;
    }
}
