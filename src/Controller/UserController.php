<?php

namespace App\Controller;

use App\Entity\User;
use App\Algorithm\Algorithm;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class UserController 
{
   
    public function __construct(TokenStorageInterface $tokenStorage,Algorithm $algo,UserPasswordEncoderInterface $userPasswordEncoder, Security $security)
    {
        $this->tokenStorage = $tokenStorage;
        $this->algo=$algo;
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->security = $security;
    }
    public function __invoke(User $data)
    {
        
        //variable role user connecté
        $userRoles=$this->tokenStorage->getToken()->getUser()->getRoles()[0];
       //dd($userRoles);
        //variable role user à modifier
        $usersModi=$data->getRoles()[0];
        if($this->algo->isAuthorised($userRoles,$usersModi) == true){
            $data->setPassword($this->userPasswordEncoder->encodePassword($data, $data->getPlainPassword()));
          
            return $data;
        }else{
            throw new HttpException("401","Vous N'avez pas L'autorisation pour cree ce type de User");
        }
    }
}
