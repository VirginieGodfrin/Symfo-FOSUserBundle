<?php

namespace AppBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;

class RedirectAfterRegistrationSubscriber implements EventSubscriberInterface
{
	private $router;

	public function __construct(RouterInterface $router) {
		$this->router = $router;
	}

	public function onRegistrationSuccess(FormEvent $event) {
		$url = $this->router->generate('homepage'); 
		$response = new RedirectResponse($url); 
		$event->setResponse($response);
	}

	public static function getSubscribedEvents(){
	
		return [
			FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess'
		];

	}


}