<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $encoder;
    
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {

// $role = new Role("ROLE_SUPER_ADMIN");
// //$role->setLibelle("ADMIN_SYS");
// $manager->persist($role);

// $role1 = new Role("ROLE_ADMIN");
// $manager->persist($role1);


// $role2 = new Role("ROLE_CAISSIER");
// $manager->persist($role2);

// $user = new User("admin");
// $user->setPassword($this->encoder->encodePassword($user, "admin"));
// $user->setIsActive(true);
// $user->setOwner($role);
// $manager->persist($user);
//         $manager->flush();
    }
}