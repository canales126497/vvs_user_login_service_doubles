<?php

declare(strict_types=1);

namespace UserLoginService\Tests\Application;

use Mockery;
use PHPUnit\Framework\TestCase;
use UserLoginService\Application\SessionManager;
use UserLoginService\Application\UserLoginService;
use UserLoginService\Domain\User;
use UserLoginService\Infrastructure\FacebookSessionManager;

final class UserLoginServiceTest extends TestCase
{
    /**
     * @test
     */
    public function userIsLoggedIn()
    {
        $this->expectExceptionMessage("User already logged in");

        $userLoginService = new UserLoginService(new FacebookSessionManager());

        $user = new User("Nuevo usuario");
        $userLoginService->manualLogin($user);
        $userLoginService->manualLogin($user);
    }

    /**
     * @test
     */
    public function userIsNotLoggedIn()
    {
        $userLoginService = new UserLoginService(new FacebookSessionManager());

        $user = new User("Nuevo usuario");
        $userLoginService->manualLogin($user);

        $this->assertEquals(true, $userLoginService->isLogged($user));
    }

    /**
     * @test
     */
    public function canReturnNumberOfExternalActiveSessions()
    {
        $sessionManager = Mockery::mock(SessionManager::class);

        $sessionManager->allows()->getSessions()->andReturn(4);

        $userLoginService = new UserLoginService($sessionManager);
        $user = new User("user_name");



        $this->assertEquals(4, $userLoginService->getExternalSessions());
    }
}
