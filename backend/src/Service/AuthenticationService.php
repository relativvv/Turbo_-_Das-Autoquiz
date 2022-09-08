<?php declare(strict_types=1);

namespace App\Service;

use App\Authentication\UpdateIdentityRequest;
use App\Entity\TurboUser;
use App\Exception\SystemException;
use App\Repository\TurboUserRepository;
use Symfony\Component\HttpFoundation\Exception\SessionNotFoundException;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class AuthenticationService
{
    private Session $session;

    public function __construct(
        private readonly TurboUserRepository $userRepository,
        private readonly RequestStack        $requestStack,
    ) {
        try {
            $this->session = $this->requestStack->getSession();
        } catch (SessionNotFoundException $e) {
            $this->requestStack->getMainRequest()->setSession(new Session());
            $this->session = $this->requestStack->getSession();
        }
    }

    public function authenticate(string $username, string $password): TurboUser
    {
        $user = $this->userRepository->findOneByIdentity($username);

        if ($user !== null && password_verify($password, $user->getPassword())) {
            $this->session->set('identity', $user);

            return $user;
        }

        throw new SystemException('Es konnte kein Nutzer mit den angegebenen Daten gefunden wurde.', Response::HTTP_NOT_FOUND);
    }

    public function createIdentity(
        string $username,
        string $email,
        string $password
    ): TurboUser
    {
        if ($this->userRepository->userExist($username, $email)) {
            throw new SystemException('Der Nutzername oder die E-Mail Adresse ist bereits vergeben.');
        }

        $user = new TurboUser();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword(password_hash($password, PASSWORD_DEFAULT));

        $this->userRepository->add($user, true);
        return $user;
    }

    public function destroy(): void
    {
        if ($this->session->has('identity')) {
            $this->session->invalidate();
        }
    }

    public function getSecret(): string
    {
        /** @var $identity TurboUser|null */
        if (null === $identity = $this->session->get('identity')) {
            throw new SystemException('Nutzer nicht angemeldet.');
        }

        return $this->userRepository->fetchSecret($identity->getId());
    }

    public function isAuthorized(): void
    {
        if ($this->session->has('identity')) {
            return;
        }

        throw new SystemException('Nutzer nicht angemeldet.', Response::HTTP_UNAUTHORIZED);
    }

    public function getIdentity(bool $fresh = false): TurboUser
    {
        if (null === $identity = $this->session->get('identity')) {
            throw new SystemException('Nutzer nicht angemeldet.', Response::HTTP_UNAUTHORIZED);
        }

        if ($fresh) {
            $identity = $this->userRepository->find($identity->getId());
        }

        return $identity;
    }

    public function updateIdentity(UpdateIdentityRequest $request): TurboUser
    {
        $this->userRepository->updateUser($request->getChangeset());

        $user = $this->getIdentity(true);

        $this->session->set('identity', $user);

        return $user;
    }

    public function compareSecrets(string $secret): bool
    {
        /** @var TurboUser|null $identity */
        $identity = $this->session->get('identity');

        return $identity !== null && \password_verify($secret, $identity->getPassword());
    }
}
