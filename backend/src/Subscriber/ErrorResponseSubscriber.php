<?php declare(strict_types=1);

namespace App\Subscriber;

use App\Exception\SystemException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ErrorResponseSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if (!$exception instanceof SystemException) {
            return;
        }

        $code = $exception->getCode() !== 0 ? $exception->getCode() : Response::HTTP_BAD_REQUEST;

        $event->allowCustomResponseCode();
        $event->stopPropagation();
        $event->setResponse(new JsonResponse([
            'message' => $exception->getMessage(),
        ], $code));
    }
}