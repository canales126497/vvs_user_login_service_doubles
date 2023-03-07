<?php

namespace UserLoginService\Application;

use UserLoginService\Domain\User;
use \Exception;
use function PHPUnit\Framework\throwException;

class UserLoginService
{
    private array $loggedUsers = [];

    public function manualLogin(User $userToLog): void
    {
        if($this->isLogged($userToLog))
        {
            throw new Exception("User already logged in");
        }

        $this->loggedUsers[] = $userToLog;
    }
    public function isLogged(User $userToCheck): bool
    {
        $isLogged = false;
        $userIterator = 0;
        while(!$isLogged and $userIterator < count($this->loggedUsers))
        {
            if($this->loggedUsers[$userIterator] === $userToCheck)
                $isLogged = true;
            $userIterator = $userIterator + 1;
        }

        return $isLogged;
    }
}