<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:creer-utilisateur',
    description: 'Ajouter un nouvel utilisateur',
)]
class CreerUtilisateurCommand extends Command
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly UserPasswordHasherInterface $passwordHasher,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'Email de l\'utilisateur')
            ->addArgument('password', InputArgument::REQUIRED, 'Mot de passe en clair (sera hashé)')
            ->addArgument('roles', InputArgument::OPTIONAL, 'Rôles séparés par des virgules (ex: ROLE_ADMIN,ROLE_USER)', 'ROLE_USER')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $email = (string) $input->getArgument('email');
        $plainPassword = (string) $input->getArgument('password');
        $roleString = (string) $input->getArgument('roles');

        // On découpe la chaîne "ROLE_ADMIN,ROLE_USER" en tableau ["ROLE_ADMIN", "ROLE_USER"]
        $roles = array_map('trim', explode(',', $roleString));
        $roles = array_values(array_filter($roles));

        $user = new Utilisateur();
        $user->setEmail($email);
        $user->setRoles($roles);

        // Le mot de passe est hashé avant l’enregistrement.
        $hashedPassword = $this->passwordHasher->hashPassword($user, $plainPassword);
        $user->setPassword($hashedPassword);

        // persist = Doctrine prépare l’insertion
        // flush = Doctrine exécute réellement l’insertion en base
        $this->em->persist($user);
        $this->em->flush();

        $output->writeln('Utilisateur créé : '.$email);
        $output->writeln('Rôles : '.implode(', ', $roles));

        return Command::SUCCESS;
    }
}
