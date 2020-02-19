<?php

namespace App\Controller;

use App\Entity\Compte;
use App\Entity\Depots;
use App\Algorithm\Algorithm;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use App\Repository\UsersRepository;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class CompteController 
{
    public function __construct(RoleRepository $repo,TokenStorageInterface $tokenStorage,Algorithm $algo,UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->tokenStorage = $tokenStorage;
        $this->algo=$algo;
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->repo=$repo;
    }
    public function __invoke(Compte $data, UserRepository $use, TokenStorageInterface $tokenStorage):Compte
    {
        //dd($data);
       
        $userCreator=$this->tokenStorage->getToken()->getUser();
        
        $user=$data->getPartenaire()->getUsers()[0];
        //id partenaire 
        $iduser=$data->getPartenaire()->getId();
        //montant depot
        $montant=($data->getDepot()[count($data->getDepot())-1]->getMontant());
        $data->getDepot()[0]->setUser($userCreator);
        $data->getDepot()[0]->setDateD(new \DateTime());
        $data->setDateC(new \DateTime());
        //date creation
       $date=date_format($data->getDateC(),"Yms");
        $id=$use->getLast()[0]->getId()+1;
       if($iduser == null)
       {
        if ($user->getPassword()) 
        {
            $user->setPassword(
                $this->userPasswordEncoder->encodePassword($user, $user->getPassword())
                
            );
        }
            $data->setDateC(new \DateTime());
           // dd($user);
           //dd($this->repo->findByLibelle("ROLE_PARTENAIRE")[0]);
        $user->setRole($this->repo->findByLibelle("ROLE_PARTENAIRE")[0]);
        //dd($this->algo->validMontant($montant));
       if($this->algo->validMontant($montant)){
            $data->setSolde($montant);
            $data->setUser($userCreator);
            $data->setNumero($date.$id);
    return $data;
}else{
    throw new Exception("Le montant doit etre superieur ou égale à 500.000");
}


}
if($iduser !== null)   {

    if($this->algo->validMontant($montant)){
        $data->setSolde($montant);
        $data->setUser($userCreator);
        $data->setNumero($date.$id);
return $data;

}

}
        
      
    }
}