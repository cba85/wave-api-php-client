<?php

use PHPUnit\Framework\TestCase;
use Wave\Wave;

/**
 * Test get user
 */
class GetUserTest extends TestCase
{
    /**
     * Test get user
     *
     * @return void
     */
    public function testGetUser()
    {
        $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
        $user = $wave->getUser();
        $this->assertIsObject($user);
        $this->assertObjectHasAttribute('id', $user);
        $this->assertObjectHasAttribute('firstName', $user);
        $this->assertObjectHasAttribute('lastName', $user);
        $this->assertObjectHasAttribute('defaultEmail', $user);
        $this->assertObjectHasAttribute('createdAt', $user);
        $this->assertObjectHasAttribute('modifiedAt', $user);
    }
}
