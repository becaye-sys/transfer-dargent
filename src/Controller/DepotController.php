<?php

namespace App\Controller;

use App\Entity\Depot;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;




class DepotController
{
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function __invoke(Depot $data):Depot
    {
        //dd($this->tokenStorage->getToken()->getUser());
        $montant=$data->getMontant();
        $compte=$data->getCompte();
        $solde=$compte->getSolde();
        $userCreator=$this->tokenStorage->getToken()->getUser();

        if($montant > 0){
            $compte->setSolde($solde + $montant);
            $data->setDateD(new \DateTime());
            $data->setUser($userCreator);
            return $data;
        }else{
            throw new Exception("Le montant doit etre superieur à 0");
        }
    }
}