<?php declare(strict_types=1);

namespace App\Controller;

use App\Service\AuthenticationService;
use App\Service\ValidationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotCompromisedPassword;
use Symfony\Component\Validator\Constraints\Regex;

class UserController extends AbstractController
{
    public function __construct(
        private AuthenticationService $authenticationService,
        private ValidationService $validationService
    ) {}

    /**
     * @Route("/api/user/create", name="api.user.create", methods={"POST"})
     */
    public function create(Request $request): Response
    {
        $data = $request->request->all();

        $collection = new Collection([
            'username' => [
                new NotBlank(),
            ],
            'email' => [
                new NotBlank(),
                new Email(),
            ],
            'password' => [
                new NotBlank(),
                new Regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!\.\$%\-_])[a-zA-Z\d!\.\$%\-_]{8,64}$/'),
                new NotCompromisedPassword(),
            ],
        ]);

        $this->validationService->validate($data, $collection);

        $this->authenticationService->createIdentity(
            $data['username'],
            $data['email'],
            $data['password']
        );

        return new Response('', Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/api/user/authenticate", name="api.user.authenticate", methods={"POST"})
     */
    public function authenticate(Request $request): Response
    {
        $data = $request->request->all();

        $this->validationService->validate($data, new Collection([
            'identity' => new NotBlank(),
            'password' => new NotBlank()
        ]));

        $this->authenticationService->authenticate($request->get('identity'), $request->get('password'));

        return new Response('', Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/api/user/unauthenticate", name="api.user.unauthenticate", methods={"DELETE"})
     */
    public function unauthenticate(Request $request): Response
    {
        if ($request->getSession()->has('identity')) {
            $this->authenticationService->destroy();
        }

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}