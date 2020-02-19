<?php
namespace App\EventListener;
use Symfony\Component\HttpFoundation\RequestStack;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;



class JWTCreatedListener

{

private $requestStack;
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
        
    }

    /**
     * @param JWTCreatedEvent $event
     *
     * @return void
     */
    public function onJWTCreated(JWTCreatedEvent $event)
    {
        
        //dd($event);
        /** @var $user \AppBundle\Entity\User */

        $user = $event->getUser();
        //dd($user);
        if(!$user->getIsActive())
        {
            
            throw new CustomUserMessageAuthenticationException('Vous etes bloque');
        }
    }
    
}