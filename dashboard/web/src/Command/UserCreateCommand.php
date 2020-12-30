<?php


namespace App\Command;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserCreateCommand extends Command
{
    private UserPasswordEncoderInterface $encoder;

    private EntityManagerInterface $manager;

    public function __construct(UserPasswordEncoderInterface $encoder, EntityManagerInterface $manager, string $name = null)
    {
        parent::__construct($name);
        $this->encoder = $encoder;
        $this->manager = $manager;
    }

    protected function configure()
    {
        $this->setName('app:user:create')
            ->setAliases(['a:u:c']);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $username = $io->ask('username');
        $password = $io->askHidden('password');

        $user = new User();

        $user
            ->setUsername($username)
            ->setPassword($this->encoder->encodePassword($user, $password));

        $this->manager->persist($user);
        $this->manager->flush();

        $io->success("User created.");

        return 0;
    }

}
