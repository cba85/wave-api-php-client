<?php

use PHPUnit\Framework\TestCase;
use Wave\Wave;
use GraphQL\Exception\QueryError;

/**
 * Test create customer
 */
class CreateCustomerTest extends TestCase
{
    /**
     * Test create customer
     *
     * @return void
     */
    public function testCreateCustomer()
    {
        $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
        $customerCreate = $wave->createCustomer([], [], [
            'input' => [
                'businessId' => getenv('WAVE_BUSINESS_ID'),
                'name' => "Santa",
                'firstName' => "Saint",
                'lastName' => "Nicolas",
                'email' => "santa@claus.com",
                'address' => [
                    'city' => "North Pole",
                    'postalCode' => "H0H H0H",
                    'countryCode' => "CA"
                ],
                'currency' => "EUR"
            ]
        ]);
        $this->assertIsObject($customerCreate);
        $this->assertObjectHasAttribute('didSucceed', $customerCreate);
        $this->assertIsBool($customerCreate->didSucceed);
        $this->assertEquals(true, $customerCreate->didSucceed);
        $this->assertObjectHasAttribute('inputErrors', $customerCreate);
        $this->assertObjectHasAttribute('customer', $customerCreate);
        $this->assertIsObject($customerCreate->customer);
        $this->assertObjectHasAttribute('id', $customerCreate->customer);
        $this->assertObjectHasAttribute('name', $customerCreate->customer);
        $this->assertObjectHasAttribute('firstName', $customerCreate->customer);
        $this->assertObjectHasAttribute('lastName', $customerCreate->customer);
        $this->assertObjectHasAttribute('email', $customerCreate->customer);
        $this->assertObjectHasAttribute('mobile', $customerCreate->customer);
        $this->assertObjectHasAttribute('phone', $customerCreate->customer);
        $this->assertObjectHasAttribute('fax', $customerCreate->customer);
        $this->assertObjectHasAttribute('tollFree', $customerCreate->customer);
        $this->assertObjectHasAttribute('website', $customerCreate->customer);
        $this->assertObjectHasAttribute('createdAt', $customerCreate->customer);
        $this->assertObjectHasAttribute('modifiedAt', $customerCreate->customer);
        $this->assertObjectHasAttribute('address', $customerCreate->customer);
        $this->assertIsObject($customerCreate->customer->address);
        $this->assertObjectHasAttribute('addressLine1', $customerCreate->customer->address);
        $this->assertObjectHasAttribute('addressLine2', $customerCreate->customer->address);
        $this->assertObjectHasAttribute('city', $customerCreate->customer->address);
        $this->assertObjectHasAttribute('postalCode', $customerCreate->customer->address);
        $this->assertObjectHasAttribute('currency', $customerCreate->customer);
        $this->assertIsObject($customerCreate->customer->currency);
        $this->assertObjectHasAttribute('code', $customerCreate->customer->currency);
        $this->assertObjectHasAttribute('name', $customerCreate->customer->currency);
        $this->assertObjectHasAttribute('symbol', $customerCreate->customer->currency);
    }

    /**
     * Test create customer with correct fields
     *
     * @return void
     */
    public function testCreateCustomerWithCorrectFields()
    {
        $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
        $customerCreate = $wave->createCustomer([
            'customer' => ['id', 'name', 'email']
        ], [], [
            'input' => [
                'businessId' => getenv('WAVE_BUSINESS_ID'),
                'name' => "Santa",
                'firstName' => "Saint",
                'lastName' => "Nicolas",
                'email' => "santa@claus.com",
                'address' => [
                    'city' => "North Pole",
                    'postalCode' => "H0H H0H",
                    'countryCode' => "CA"
                ],
                'currency' => "EUR"
            ]
        ]);
        $this->assertIsObject($customerCreate);
        $this->assertObjectHasAttribute('didSucceed', $customerCreate);
        $this->assertIsBool($customerCreate->didSucceed);
        $this->assertEquals(true, $customerCreate->didSucceed);
        $this->assertObjectHasAttribute('inputErrors', $customerCreate);
        $this->assertObjectHasAttribute('customer', $customerCreate);
        $this->assertIsObject($customerCreate->customer);
        $this->assertObjectHasAttribute('id', $customerCreate->customer);
        $this->assertObjectHasAttribute('name', $customerCreate->customer);
        $this->assertObjectNotHasAttribute('firstName', $customerCreate->customer);
        $this->assertObjectNotHasAttribute('lastName', $customerCreate->customer);
        $this->assertObjectHasAttribute('email', $customerCreate->customer);
        $this->assertObjectNotHasAttribute('mobile', $customerCreate->customer);
        $this->assertObjectNotHasAttribute('phone', $customerCreate->customer);
        $this->assertObjectNotHasAttribute('fax', $customerCreate->customer);
        $this->assertObjectNotHasAttribute('tollFree', $customerCreate->customer);
        $this->assertObjectNotHasAttribute('website', $customerCreate->customer);
        $this->assertObjectNotHasAttribute('createdAt', $customerCreate->customer);
        $this->assertObjectNotHasAttribute('modifiedAt', $customerCreate->customer);
        $this->assertObjectHasAttribute('address', $customerCreate->customer);
        $this->assertIsObject($customerCreate->customer->address);
        $this->assertObjectHasAttribute('addressLine1', $customerCreate->customer->address);
        $this->assertObjectHasAttribute('addressLine2', $customerCreate->customer->address);
        $this->assertObjectHasAttribute('city', $customerCreate->customer->address);
        $this->assertObjectHasAttribute('postalCode', $customerCreate->customer->address);
        $this->assertObjectHasAttribute('currency', $customerCreate->customer);
        $this->assertIsObject($customerCreate->customer->currency);
        $this->assertObjectHasAttribute('code', $customerCreate->customer->currency);
        $this->assertObjectHasAttribute('name', $customerCreate->customer->currency);
        $this->assertObjectHasAttribute('symbol', $customerCreate->customer->currency);
    }

    /**
     * Test create customer with incorrect fields
     *
     * @return void
     */
    public function testCreateCustomerWithIncorrectFields()
    {
        $this->expectException(QueryError::class);
        $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
        $wave->createCustomer([
            'customer' => ['uuid']
        ], [], [
            'input' => [
                'businessId' => getenv('WAVE_BUSINESS_ID'),
                'name' => "Santa",
                'firstName' => "Saint",
                'lastName' => "Nicolas",
                'email' => "santa@claus.com",
                'address' => [
                    'city' => "North Pole",
                    'postalCode' => "H0H H0H",
                    'countryCode' => "CA"
                ],
                'currency' => "EUR"
            ]
        ]);
    }

    /**
     * Test create customer with incorrect variables
     *
     * @return void
     */
    public function testCreateCustomerWithIncorrectVariables()
    {
        $this->expectException(QueryError::class);
        $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
        $customerCreate = $wave->createCustomer([], [], [
            'input' => [
                'businessId' => '1234567890',
                'name' => "Santa",
                'firstName' => "Saint",
                'lastName' => "Nicolas",
                'email' => "santa@claus.com",
                'address' => [
                    'city' => "North Pole",
                    'postalCode' => "H0H H0H",
                    'countryCode' => "CA"
                ],
                'currency' => "EUR"
            ]
        ]);
    }
}
