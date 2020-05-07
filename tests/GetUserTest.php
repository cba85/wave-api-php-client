<?php

use PHPUnit\Framework\TestCase;
use Wave\Wave;
use GraphQL\Exception\QueryError;

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

    /**
     * Test get user with correct fields
     *
     * @return void
     */
    public function testGetUserWithCorrectFields()
    {
        $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
        $user = $wave->getUser(['user' => ['id', 'defaultEmail']]);
        $this->assertIsObject($user);
        $this->assertObjectHasAttribute('id', $user);
        $this->assertObjectNotHasAttribute('firstName', $user);
        $this->assertObjectNotHasAttribute('lastName', $user);
        $this->assertObjectHasAttribute('defaultEmail', $user);
        $this->assertObjectNotHasAttribute('createdAt', $user);
        $this->assertObjectNotHasAttribute('modifiedAt', $user);
    }

    /**
     * Test get user with incorrect fields
     *
     * @return void
     */
    public function testGetUserWithIncorrectFields()
    {
        $this->expectException(QueryError::class);
        $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
        $wave->getUser(['user' => ['id', 'name']]);
    }
}
