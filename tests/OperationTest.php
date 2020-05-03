<?php

use PHPUnit\Framework\TestCase;
use Wave\Wave;

/**
 * Test operation
 */
class OperationTest extends TestCase
{
    /**
     * Test dynamic method calling
     *
     * @return void
     */
    public function testDynamicMethodCalling()
    {
        $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
        $user = $wave->getUser();
        $this->assertIsObject($user);
    }

    /**
     * Test dynamic method calling with an incorrect operation name
     *
     * @return void
     */
    public function testDynamicMethodCallingIncorrectOperation()
    {
        $this->expectException(\Exception::class);
        $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
        $user = $wave->getUsers();
    }
}
