<?php

namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $haser
    )
    {}

    public function load(ObjectManager $manager): void
    {
        $admin = new User;
        $hash = $this->haser->hashPassword($admin, "password");
        $admin->setEmail("admin")
        ->setFullName("Admin")
        ->setPassword($hash)
        ->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        for($u=0; $u<5; $u++) {
            $user = new User();
            $hash = $this->haser->hashPassword($user, "password");
            $user->setEmail("user$u@gmail.com")
            ->setFullName("user$u")
            ->setPassword($hash);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
