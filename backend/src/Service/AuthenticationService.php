<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\TurboUser;
use App\Exception\SystemException;
use App\Repository\TurboUserRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;

class AuthenticationService
{
    private Session $session;

    public function __construct(
        private TurboUserRepository $userRepository,
        private RequestStack $requestStack,
    ) {
        $this->session = $this->requestStack->getSession();
    }

    public function authenticate(string $username, string $password): TurboUser
    {
        $user = $this->userRepository->findOneByIdentity($username);

        if ($user !== null && password_verify($password, $user->getPassword())) {
            $this->session->set('identity', $user);

            return $user;
        }

        throw new SystemException('Es konnte kein Nutzer mit den angegebenen Daten gefunden wurde.');
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
}
