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
    public function canReturnLoggedUsersList()
    {
        $userLoginService = new UserLoginService();

        $users = [
            new User("Nuevo usuario1"),
            new User("Nuevo usuario2"),
            new User("Nuevo usuario3"),
            new User("Nuevo usuario4"),
        ];
        foreach ($users as $userIterator => $user)
        {
            $userLoginService->manualLogin($user);
        }
        $userList = $userLoginService->getLoggedUsers();
        $listIsComplete = true;
        $userIterator = 0;
        while($listIsComplete and $userIterator < count($users))
        {
            if($userList[$userIterator] !== $users[$userIterator])
                $listIsComplete = false;
            $userIterator = $userIterator + 1;
        }

        $this->assertTrue($listIsComplete);
    }
}
