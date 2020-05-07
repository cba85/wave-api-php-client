<?php

use PHPUnit\Framework\TestCase;
use Wave\Wave;
use GraphQL\Exception\QueryError;

/**
 * Test get customer by id
 */
class GetCustomerByIdTest extends TestCase
{
    /**
     * Test get customer by id
     *
     * @return void
     */
    public function testGetCustomerById()
    {
        $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
        $customer = $wave->getCustomerById([], [], [
            'businessId' => getenv('WAVE_BUSINESS_ID'),
            'customerId' => getenv('WAVE_CUSTOMER_ID')
        ]);
        $this->assertIsObject($customer);
        $this->assertObjectHasAttribute('id', $customer);
        $this->assertObjectHasAttribute('name', $customer);
        $this->assertObjectHasAttribute('firstName', $customer);
        $this->assertObjectHasAttribute('lastName', $customer);
        $this->assertObjectHasAttribute('email', $customer);
        $this->assertObjectHasAttribute('mobile', $customer);
        $this->assertObjectHasAttribute('phone', $customer);
        $this->assertObjectHasAttribute('fax', $customer);
        $this->assertObjectHasAttribute('tollFree', $customer);
        $this->assertObjectHasAttribute('website', $customer);
        $this->assertObjectHasAttribute('createdAt', $customer);
        $this->assertObjectHasAttribute('modifiedAt', $customer);
        $this->assertObjectHasAttribute('address', $customer);
        $this->assertIsObject($customer->address);
        $this->assertObjectHasAttribute('addressLine1', $customer->address);
        $this->assertObjectHasAttribute('addressLine2', $customer->address);
        $this->assertObjectHasAttribute('city', $customer->address);
        $this->assertObjectHasAttribute('postalCode', $customer->address);
        $this->assertObjectHasAttribute('currency', $customer);
        $this->assertIsObject($customer->currency);
        $this->assertObjectHasAttribute('code', $customer->currency);
        $this->assertObjectHasAttribute('name', $customer->currency);
        $this->assertObjectHasAttribute('symbol', $customer->currency);
    }

    /**
     * Test get customer by id with correct fields
     *
     * @return void
     */
    public function testGetCustomerByIdWithCorrectFields()
    {
        $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
        $customer = $wave->getCustomerById([
            'customer' => ['id', 'name', 'email']
        ], [], [
            'businessId' => getenv('WAVE_BUSINESS_ID'),
            'customerId' => getenv('WAVE_CUSTOMER_ID')
        ]);
        $this->assertIsObject($customer);
        $this->assertObjectHasAttribute('id', $customer);
        $this->assertObjectHasAttribute('name', $customer);
        $this->assertObjectNotHasAttribute('firstName', $customer);
        $this->assertObjectNotHasAttribute('lastName', $customer);
        $this->assertObjectHasAttribute('email', $customer);
        $this->assertObjectNotHasAttribute('mobile', $customer);
        $this->assertObjectNotHasAttribute('phone', $customer);
        $this->assertObjectNotHasAttribute('fax', $customer);
        $this->assertObjectNotHasAttribute('tollFree', $customer);
        $this->assertObjectNotHasAttribute('website', $customer);
        $this->assertObjectNotHasAttribute('createdAt', $customer);
        $this->assertObjectNotHasAttribute('modifiedAt', $customer);
        $this->assertObjectHasAttribute('address', $customer);
        $this->assertIsObject($customer->address);
        $this->assertObjectHasAttribute('addressLine1', $customer->address);
        $this->assertObjectHasAttribute('addressLine2', $customer->address);
        $this->assertObjectHasAttribute('city', $customer->address);
        $this->assertObjectHasAttribute('postalCode', $customer->address);
        $this->assertObjectHasAttribute('currency', $customer);
        $this->assertIsObject($customer->currency);
        $this->assertObjectHasAttribute('code', $customer->currency);
        $this->assertObjectHasAttribute('name', $customer->currency);
        $this->assertObjectHasAttribute('symbol', $customer->currency);
    }

    /**
     * Test get customer by id with incorrect fields
     *
     * @return void
     */
    public function testGetCustomerByIdWithIncorrectFields()
    {
        $this->expectException(QueryError::class);
        $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
        $wave->getCustomerById([
            'customer' => ['uuid']
        ], [], [
            'businessId' => getenv('WAVE_BUSINESS_ID'),
            'customerId' => getenv('WAVE_CUSTOMER_ID')
        ]);
    }
}
