<?php
namespace App\DataPersister;

use DateTime;
use App\Entity\Compte;
use App\Entity\Contrat;
use App\Repository\TermesRepository;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class ContratPersiter implements DataPersisterInterface
{
    
    
    public function __construct(TermesRepository $terme,EntityManagerInterface $entityManager,TokenStorageInterface $tokenStorage )
    {       
        $this->entityManager = $entityManager;
        $this->tokenStorage = $tokenStorage;
        $this->terme=$terme;
       
    }
    public function supports($data): bool
    {
        return $data instanceof Compte;
       
        // TODO: Implement supports() method.
    }
    public function persist($data)
    {
        $v=2;
        if($data->getPartenaire()->getId() == null){
            $v=1;
        }
                $this->entityManager->persist($data);
                $this->entityManager->flush();
              if($v==1){
                $contrats= new Contrat();
                $contrats->setPartenaire($data->getPartenaire());
                $contrats->setDateCo(new DateTime());
                $contrats->setTermes($this->terme->findAll()[0]->getTermes());
               return $contrats->genContrat($contrats);
              }
                
    }
    public function remove($data)
    {
        $this->entityManager->remove($data);
        $this->entityManager->flush();
    }
}