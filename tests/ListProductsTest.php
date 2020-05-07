<?php

use PHPUnit\Framework\TestCase;
use Wave\Wave;
use GraphQL\Exception\QueryError;

/**
 * Test list products
 */
class ListProductsTest extends TestCase
{
    /**
     * Test list products
     *
     * @return void
     */
    public function testListProducts()
    {
        $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
        $products = $wave->listProducts([], [], [
            'businessId' => getenv('WAVE_BUSINESS_ID'),
            'page' => 1,
            'pageSize' => 1
        ]);
        $this->assertIsObject($products);
        $this->assertObjectHasAttribute('pageInfo', $products);
        $this->assertObjectHasAttribute('edges', $products);
        $this->assertObjectHasAttribute('currentPage', $products->pageInfo);
        $this->assertObjectHasAttribute('totalPages', $products->pageInfo);
        $this->assertObjectHasAttribute('totalCount', $products->pageInfo);
        $this->assertObjectHasAttribute('id', $products->edges[0]->node);
        $this->assertObjectHasAttribute('name', $products->edges[0]->node);
        $this->assertObjectHasAttribute('description', $products->edges[0]->node);
        $this->assertObjectHasAttribute('unitPrice', $products->edges[0]->node);
        $this->assertObjectHasAttribute('isSold', $products->edges[0]->node);
        $this->assertObjectHasAttribute('isBought', $products->edges[0]->node);
        $this->assertObjectHasAttribute('isArchived', $products->edges[0]->node);
        $this->assertObjectHasAttribute('createdAt', $products->edges[0]->node);
        $this->assertObjectHasAttribute('modifiedAt', $products->edges[0]->node);
    }

    /**
     * Test list products with correct fields
     *
     * @return void
     */
    public function testListProductsWithCorrectFields()
    {
        $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
        $products = $wave->listProducts(['pageInfo' => ['totalCount']], [], [
            'businessId' => getenv('WAVE_BUSINESS_ID'),
            'page' => 1,
            'pageSize' => 1
        ]);
        $this->assertIsObject($products);
        $this->assertObjectHasAttribute('pageInfo', $products);
        $this->assertObjectHasAttribute('edges', $products);
        $this->assertObjectNotHasAttribute('currentPage', $products->pageInfo);
        $this->assertObjectNotHasAttribute('totalPages', $products->pageInfo);
        $this->assertObjectHasAttribute('totalCount', $products->pageInfo);
        $this->assertObjectHasAttribute('id', $products->edges[0]->node);
        $this->assertObjectHasAttribute('name', $products->edges[0]->node);
        $this->assertObjectHasAttribute('description', $products->edges[0]->node);
        $this->assertObjectHasAttribute('unitPrice', $products->edges[0]->node);
        $this->assertObjectHasAttribute('isSold', $products->edges[0]->node);
        $this->assertObjectHasAttribute('isBought', $products->edges[0]->node);
        $this->assertObjectHasAttribute('isArchived', $products->edges[0]->node);
        $this->assertObjectHasAttribute('createdAt', $products->edges[0]->node);
        $this->assertObjectHasAttribute('modifiedAt', $products->edges[0]->node);
    }

    /**
     * Test list products with incorrect fields
     *
     * @return void
     */
    public function testListProductsWithIncorrectFields()
    {
        $this->expectException(QueryError::class);
        $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
        $wave->listProducts(['pageInfo' => ['count']]);
    }

    /**
     * Test list products with incorrect variables
     *
     * @return void
     */
    public function testListProductsWithIncorrectVariables()
    {
        $this->expectException(QueryError::class);
        $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
        $wave->listProducts([], [], [
            'businessId' => '1234567890',
            'page' => 1,
            'pageSize' => 1
        ]);
    }
}
