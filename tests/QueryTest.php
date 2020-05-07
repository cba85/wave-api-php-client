<?php

use PHPUnit\Framework\TestCase;
use Wave\Wave;
use GraphQL\Query;

/**
 * Test query
 */
class QueryTest extends TestCase
{
    /**
     * Test correct query
     *
     * @return void
     */
    public function testCorrectQuery()
    {
        $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
        $gql = (new Query('user'))->setSelectionSet(['id']);
        $results = $wave->client->runQuery($gql);
        $user = $results->getData()->user;
        $this->assertIsObject($user);
    }

    /**
     * Test incorrect query
     *
     * @return void
     */
    public function testIncorrectQuery()
    {
        $this->expectException(\Exception::class);
        $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
        $gql = (new Query('user'))->setSelectionSet(['uid']);
        $wave->client->runQuery($gql);
    }
}
