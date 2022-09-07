<?php declare(strict_types=1);

namespace App\Service;

use App\Exception\SystemException;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValidationService
{
    public function __construct(private ValidatorInterface $validator)
    {
    }

    public function validate(array $data, Collection $collection, bool $singleMessage = false): void
    {
        $violations = $this->validator->validate($data, $collection);

        if ($violations->count() <= 0) {
            return;
        }

        if ($singleMessage) {
            throw new SystemException($violations->offsetGet(0)->getMessage());
        }

        throw new SystemException($this->buildExceptionMessage($violations));
    }

    private function buildExceptionMessage(ConstraintViolationListInterface $violations): string
    {
        $message = '';

        foreach ($violations as $violation) {
            $message .= $violation->getPropertyPath() . ': ' . $violation->getMessage() . \PHP_EOL;
        }

        return $message;
    }
}