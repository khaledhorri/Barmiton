<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }

    public function load(ObjectManager $manager)
    {
        $user = new User();

        $user
            ->setUsername("admin")
            ->setPassword($this->passwordEncoder->encodePassword($user,'admin'))
            ->setRoles(['ROLE_ADMIN'])
            ->setEmail('horkhaled@gmail.com');


        $manager->persist($user);

        $manager->flush();
    }
}
