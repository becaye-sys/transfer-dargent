<?php

namespace App\Controller;

use App\Entity\Depots;
use App\Entity\Compte;
use App\Algorithm\Algorithm;
use App\Repository\RoleRepository;
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
    public function __invoke(Compte $data,TokenStorageInterface $tokenStorage):Compte
    {
        //dd($data);
        //usercreator
        $userCreator=$this->tokenStorage->getToken()->getUser();
        //password du user partenaire
        $userPass=$data->getPartenaire()->getUsers()[0]->getPassword();
        //le user
        $user=$data->getPartenaire()->getUsers()[0];
        //id partenaire 
        $iduser=$data->getPartenaire()->getId();
        //montant depot
        // $montant=($data->getDepots()[count($data->getDepots())-1]->getMontant());
        $data->getDepot()[0]->setUser($userCreator);
        //date creation
        // $date=date_format($data->getCreatAt(),"Yms");
        // $id=$use->getLast()[0]->getId()+1;
       if($iduser == null){
        if ($user->getPlainPassword()) {
            $user->setPassword(
                $this->userPasswordEncoder->encodePassword($user, $user->getPlainPassword())
                
            );}
           // dd($user);
           //dd($this->repo->findByLibelle("ROLE_PARTENAIRE")[0]);
        $user->setRole($this->repo->findByLibelle("ROLE_PARTENAIRE")[0]);
        
    //    ($this->algo->validMontant($montant));
    //         $data->setSolde($montant);
    //         $data->setUserC
    return $data;
}
        // if($this->algo->validMontant($montant)){
        //     ddreator($userCreator);
        //     $data->setNumero($date.$id);
          
        // }
        // else{
        //     throw new Exception("Le montant doit etre superieur ou égale à 500.000");
        // }
            
        
      
    }
}