<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
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
        $user->setPseudo("jojo");
        $user->setEmail("j@flan.fr");
        $user->setRoles(["ROLE_USER"]);

        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'abcd'
        ));
        $manager->persist($user);

        $user1 = new User();
        $user1->setPseudo("jeje");
        $user1->setEmail("jeje@flan.fr");
        $user1->setRoles(["ROLE_USER"]);

        $user1->setPassword($this->passwordEncoder->encodePassword(
            $user1,
            '1234'
        ));
        $manager->persist($user1);
        $manager->flush();
    }
}
