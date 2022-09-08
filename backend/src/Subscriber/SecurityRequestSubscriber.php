<?php declare(strict_types=1);

namespace App\Subscriber;

use App\Entity\TurboUser;
use App\Service\AuthenticationService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class SecurityRequestSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly AuthenticationService $authenticationService)
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
        ];
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();

        /** @var $identity TurboUser|null */
        if (null === $identity = $request->getSession()->get('identity')) {
            return;
        }

        if ($identity->getPassword() === $this->authenticationService->getSecret()) {
            return;
        }

        $this->authenticationService->destroy();
    }
}
