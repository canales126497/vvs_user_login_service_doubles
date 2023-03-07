<?php

declare(strict_types=1);

namespace UserLoginService\Tests\Application;

use PHPUnit\Framework\TestCase;
use UserLoginService\Application\UserLoginService;
use UserLoginService\Domain\User;

final class UserLoginServiceTest extends TestCase
{
    /**
     * @test
     */
    public function userIsLoggedIn()
    {
        $this->expectExceptionMessage("User already logged in");

        $userLoginService = new UserLoginService();

        $user = new User("Nuevo usuario");
        $userLoginService->manualLogin($user);
        $userLoginService->manualLogin($user);
    }

    /**
     * @test
     */
    public function userIsNotLoggedIn()
    {
        $userLoginService = new UserLoginService();

        $user = new User("Nuevo usuario");
        $userLoginService->manualLogin($user);

        $this->assertEquals(true, $userLoginService->isLogged($user));
    }

    /**
     * @test
     */
    public function canReturnNumberOfExternalActiveSessions()
    {
        $userLoginService = new UserLoginService();

        $user = new User("Nuevo usuario");
        $userLoginService->manualLogin($user);

        $this->assertEquals(4, $userLoginService->getExternalSessions());
    }
}
