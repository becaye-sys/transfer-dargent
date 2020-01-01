<?php

namespace App\DataFixtures;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use App\Entity\Role;
use App\Repository\RoleRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    private $encoder;
    private $repo;
    public function __construct(UserPasswordEncoderInterface $encoder, RoleRepository $repo)
    {
        $this->encoder = $encoder;
        $this->repo = $repo;
        
    }

    public function load(ObjectManager $manager)
    {
        $role = $this->repo->findAll();
        $user = new User();
        $user->setUsername("superadmin");
        $user->setPassword($this->encoder->encodePassword($user, "becaye"));
        $user->setRoles($role);
        $manager->persist($user);
        $manager->flush();
    }
}
