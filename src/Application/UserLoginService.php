<?php

namespace UserLoginService\Application;

use UserLoginService\Domain\User;
use UserLoginService\Infrastructure\FacebookSessionManager;
use \Exception;
use function PHPUnit\Framework\throwException;

class UserLoginService
{
    private array $loggedUsers = [];
    private SessionManager $sessionManager;

    function __construct($sessionMaager){
        $this->sessionManager = $sessionMaager;
    }

    public function manualLogin(User $userToLog): void
    {
        if($this->isLogged($userToLog))
        {
            throw new Exception("User already logged in");
        }

        $this->loggedUsers[] = $userToLog;
    }
    public function getLoggedUsers(): array
    {
        return $this->loggedUsers;
    }

    public function getExternalSessions(): int
    {
        return $this->sessionManager->getSessions();
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