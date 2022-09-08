<?php declare(strict_types=1);

namespace App\Authentication;

use App\Entity\TurboUser;

class UpdateIdentityRequest
{
    private readonly int $id;

    public function __construct(
        private readonly TurboUser $identity,
        public ?string $email = null,
        public ?string $password = null,
        public ?string $image = null
    ) {
        $this->id = $identity->getId();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getChangeset(): array
    {
        $changeset['id'] = $this->id;
        $changeset['email'] = $this->email ?? $this->identity->getEmail();
        $changeset['password'] = $this->password ?? $this->identity->getPassword();
        $changeset['image'] = $this->image ?? $this->identity->getImage();

        return $changeset;
    }
}