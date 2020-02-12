<?php
namespace App\DataPersister;

use DateTime;
use App\Entity\Users;
use App\Entity\Compte;
use App\Entity\Comptes;
use App\Entity\Contrat;
use App\Entity\Contrats;
use App\Algorithm\Algorithm;
use App\Entity\Transactions;
use App\Repository\TermesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
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