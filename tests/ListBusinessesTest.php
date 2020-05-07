<?php

use PHPUnit\Framework\TestCase;
use Wave\Wave;
use GraphQL\Exception\QueryError;

/**
 * Test list businesses
 */
class ListBusinessesTest extends TestCase
{
    /**
     * Test list businesses
     *
     * @return void
     */
    public function testListBusinesses()
    {
        $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
        $businesses = $wave->listBusinesses();
        $this->assertIsObject($businesses);
        $this->assertObjectHasAttribute('pageInfo', $businesses);
        $this->assertObjectHasAttribute('edges', $businesses);
        $this->assertObjectHasAttribute('currentPage', $businesses->pageInfo);
        $this->assertObjectHasAttribute('totalPages', $businesses->pageInfo);
        $this->assertObjectHasAttribute('totalCount', $businesses->pageInfo);
        $this->assertObjectHasAttribute('id', $businesses->edges[0]->node);
        $this->assertObjectHasAttribute('name', $businesses->edges[0]->node);
        $this->assertObjectHasAttribute('isClassicAccounting', $businesses->edges[0]->node);
        $this->assertObjectHasAttribute('isClassicInvoicing', $businesses->edges[0]->node);
        $this->assertObjectHasAttribute('isPersonal', $businesses->edges[0]->node);
    }

    /**
     * Test list businesses with correct fields
     *
     * @return void
     */
    public function testListBusinessesWithCorrectFields()
    {
        $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
        $businesses = $wave->listBusinesses(['pageInfo' => ['totalCount']]);
        $this->assertIsObject($businesses);
        $this->assertObjectHasAttribute('pageInfo', $businesses);
        $this->assertObjectHasAttribute('edges', $businesses);
        $this->assertObjectNotHasAttribute('currentPage', $businesses->pageInfo);
        $this->assertObjectNotHasAttribute('totalPages', $businesses->pageInfo);
        $this->assertObjectHasAttribute('totalCount', $businesses->pageInfo);
        $this->assertObjectHasAttribute('id', $businesses->edges[0]->node);
        $this->assertObjectHasAttribute('name', $businesses->edges[0]->node);
        $this->assertObjectHasAttribute('isClassicAccounting', $businesses->edges[0]->node);
        $this->assertObjectHasAttribute('isClassicInvoicing', $businesses->edges[0]->node);
        $this->assertObjectHasAttribute('isPersonal', $businesses->edges[0]->node);
    }

    /**
     * Test list businesses with incorrect fields
     *
     * @return void
     */
    public function testListBusinessesWithIncorrectFields()
    {
        $this->expectException(QueryError::class);
        $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
        $wave->listBusinesses(['pageInfo' => ['count']]);
    }

    /**
     * Test list businesses with correct arguments
     *
     * @return void
     */
    public function testListBusinessesWithCorrectArguments()
    {
        $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
        $businesses = $wave->listBusinesses([], ['businesses' => ['pageSize' => 25]]);
        $this->assertIsObject($businesses);
        $this->assertObjectHasAttribute('pageInfo', $businesses);
        $this->assertObjectHasAttribute('edges', $businesses);
        $this->assertObjectHasAttribute('currentPage', $businesses->pageInfo);
        $this->assertObjectHasAttribute('totalPages', $businesses->pageInfo);
        $this->assertObjectHasAttribute('totalCount', $businesses->pageInfo);
        $this->assertObjectHasAttribute('id', $businesses->edges[0]->node);
        $this->assertObjectHasAttribute('name', $businesses->edges[0]->node);
        $this->assertObjectHasAttribute('isClassicAccounting', $businesses->edges[0]->node);
        $this->assertObjectHasAttribute('isClassicInvoicing', $businesses->edges[0]->node);
        $this->assertObjectHasAttribute('isPersonal', $businesses->edges[0]->node);
    }

    /**
     * Test list businesses with incorrect arguments
     *
     * @return void
     */
    public function testListBusinessesWithIncorrectArguments()
    {
        $this->expectException(QueryError::class);
        $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
        $wave->listBusinesses([], ['businesses' => ['pageSize' => "ok"]]);
    }
}
