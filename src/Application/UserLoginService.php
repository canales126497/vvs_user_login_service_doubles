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
        foreach($this->loggedUsers as $userIterator => $currentUser)
        {
            if($currentUser === $userToCheck)
                return true;
        }

        return false;
    }
}