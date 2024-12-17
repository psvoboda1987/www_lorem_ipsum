<?php

declare(strict_types = 1);

namespace App\Service;

use Nette\Database\Explorer;
use Nette\Security\AuthenticationException;
use Nette\Security\Passwords;
use Nette\Security\SimpleIdentity;

class Authenticator implements \Nette\Security\Authenticator
{
    public function __construct(
        private readonly Explorer $database,
        private readonly Passwords $passwords
    ) {
    }

    public function authenticate(string $user, string $password): SimpleIdentity
    {
        $row = $this->database->table('user')
            ->where('email', $user)
            ->fetch();

        if ($row === null) {
            throw new AuthenticationException('User not found.');
        }

        if (!$this->passwords->verify($password, $row->offsetGet('password'))) {
            throw new AuthenticationException('Invalid password.');
        }

        return new SimpleIdentity(
            $row->offsetGet('id'),
            $row->offsetGet('role'), // nebo pole více rolí
            ['name' => $row->offsetGet('name')]
        );
    }
}
