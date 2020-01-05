<?php
namespace App\DataFixtures;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use App\Entity\Role;
use App\Repository\RoleRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
class UserFixture extends Fixture
{
    public function __construct()
    {
        
    }
    public function load(ObjectManager $manager)
    {
        $user = new User("admin");
        $user->setPassword($this->encoder->encodePassword($user, "admin"));
        $user->setRoles(json_encode(array("ROLE_ADMIN")));
        $manager->persist($user);

        $manager->flush();
    }
}
