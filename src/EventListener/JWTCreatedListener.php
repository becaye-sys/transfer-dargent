<?php
namespace App\EventListener;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Config\Definition\Exception\Exception;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;



class JWTCreatedListener
{
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
        
        dd($event);
        /** @var $user \AppBundle\Entity\User */

        $user = $event->getUser();
        dd($user);
        if(!$user->getIsActive())
        {
            throw new Exception('Vous etes bloqué');

        }
    }
}