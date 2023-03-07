<?php

declare(strict_types=1);

namespace UserLoginService\Tests\Application;

use PHPUnit\Framework\TestCase;
use UserLoginService\Application\UserLoginService;

final class UserLoginServiceTest extends TestCase
{
    /**
     * @test
     */
    public function userIsLoggedIn()
    {
        $userLoginService = new UserLoginService();

        $user = new User("Nuevo usuario");
        $userLoginService->manualLogin($user);

        $this->assertEquals("user logged", $userLoginService->isLogged($user));
    }
}