<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use App\Entity\Termes;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
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

// $termes = new Termes();
// $termes->setTermes("Le présent contrat est un contrat de prestation de conseil ayant pour objet la mission définie au cahier des charges annexé au présent contrat et en faisant partie intégrante.

// En contrepartie de la réalisation des prestations définies à l'Article premier ci-dessus, le client versera au prestataire la somme forfaitaire de _______________ euros, ventilée de la manière suivante:

// 20% à la signature des présentes ;

// 30% au (n) jour suivant la signature des présentes ;

// 50% constituant le solde, à la réception de la tâche.

// Les frais engagés par le prestataire : déplacement, hébergement, repas et frais annexes de dactylographie, reprographie, etc., nécessaires à l'exécution de la prestation, seront facturés en sus au client sur relevé de dépenses.

// Les sommes prévues ci-dessus seront payées par chèque, dans les huit jours de la réception de la facture, droits et taxes en sus.");
// $manager->persist($termes);
//          $manager->flush();


    }
}