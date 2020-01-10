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
$role = new Role();
$role->setLibelle("ADMIN_SYS");
$manager->persist($role);

$user = new User();
$user->setUsername("supadmin");
$user->setPassword($this->encoder->encodePassword($user, "system"));
$user->setRoles(array("ROLE_".$role->getLibelle()));
$user->setIsActive(true);
$user->setOwner($role);

$manager->persist($user);
        $manager->flush();
    }
}