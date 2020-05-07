<?php

use PHPUnit\Framework\TestCase;
use Wave\Wave;
use GraphQL\Exception\QueryError;

/**
 * Test patch customer
 */
class PatchCustomerTest extends TestCase
{
    /**
     * Test patch customer
     *
     * @return void
     */
    public function testPatchCustomer()
    {
        $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
        $customerPatch = $wave->patchCustomer([], [], [
            'input' => [
                'id' => getenv('WAVE_CUSTOMER_ID'),
                'email' => "new@email.com"
            ]
        ]);
        $this->assertIsObject($customerPatch);
        $this->assertObjectHasAttribute('didSucceed', $customerPatch);
        $this->assertIsBool($customerPatch->didSucceed);
        $this->assertEquals(true, $customerPatch->didSucceed);
        $this->assertObjectHasAttribute('inputErrors', $customerPatch);
        $this->assertObjectHasAttribute('customer', $customerPatch);
        $this->assertIsObject($customerPatch->customer);
        $this->assertObjectHasAttribute('id', $customerPatch->customer);
        $this->assertObjectHasAttribute('name', $customerPatch->customer);
        $this->assertObjectHasAttribute('firstName', $customerPatch->customer);
        $this->assertObjectHasAttribute('lastName', $customerPatch->customer);
        $this->assertObjectHasAttribute('email', $customerPatch->customer);
        $this->assertObjectHasAttribute('mobile', $customerPatch->customer);
        $this->assertObjectHasAttribute('phone', $customerPatch->customer);
        $this->assertObjectHasAttribute('fax', $customerPatch->customer);
        $this->assertObjectHasAttribute('tollFree', $customerPatch->customer);
        $this->assertObjectHasAttribute('website', $customerPatch->customer);
        $this->assertObjectHasAttribute('createdAt', $customerPatch->customer);
        $this->assertObjectHasAttribute('modifiedAt', $customerPatch->customer);
        $this->assertObjectHasAttribute('address', $customerPatch->customer);
        $this->assertIsObject($customerPatch->customer->address);
        $this->assertObjectHasAttribute('addressLine1', $customerPatch->customer->address);
        $this->assertObjectHasAttribute('addressLine2', $customerPatch->customer->address);
        $this->assertObjectHasAttribute('city', $customerPatch->customer->address);
        $this->assertObjectHasAttribute('postalCode', $customerPatch->customer->address);
        $this->assertObjectHasAttribute('currency', $customerPatch->customer);
        $this->assertIsObject($customerPatch->customer->currency);
        $this->assertObjectHasAttribute('code', $customerPatch->customer->currency);
        $this->assertObjectHasAttribute('name', $customerPatch->customer->currency);
        $this->assertObjectHasAttribute('symbol', $customerPatch->customer->currency);
    }

    /**
     * Test patch customer with correct fields
     *
     * @return void
     */
    public function testPatchCustomerWithCorrectFields()
    {
        $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
        $customerPatch = $wave->patchCustomer([
            'customer' => ['id', 'name', 'email']
        ], [], [
            'input' => [
                'id' => getenv('WAVE_CUSTOMER_ID'),
                'email' => "new2@email.com"
            ]
        ]);
        $this->assertIsObject($customerPatch);
        $this->assertObjectHasAttribute('didSucceed', $customerPatch);
        $this->assertIsBool($customerPatch->didSucceed);
        $this->assertEquals(true, $customerPatch->didSucceed);
        $this->assertObjectHasAttribute('inputErrors', $customerPatch);
        $this->assertObjectHasAttribute('customer', $customerPatch);
        $this->assertIsObject($customerPatch->customer);
        $this->assertObjectHasAttribute('id', $customerPatch->customer);
        $this->assertObjectHasAttribute('name', $customerPatch->customer);
        $this->assertObjectNotHasAttribute('firstName', $customerPatch->customer);
        $this->assertObjectNotHasAttribute('lastName', $customerPatch->customer);
        $this->assertObjectHasAttribute('email', $customerPatch->customer);
        $this->assertObjectNotHasAttribute('mobile', $customerPatch->customer);
        $this->assertObjectNotHasAttribute('phone', $customerPatch->customer);
        $this->assertObjectNotHasAttribute('fax', $customerPatch->customer);
        $this->assertObjectNotHasAttribute('tollFree', $customerPatch->customer);
        $this->assertObjectNotHasAttribute('website', $customerPatch->customer);
        $this->assertObjectNotHasAttribute('createdAt', $customerPatch->customer);
        $this->assertObjectNotHasAttribute('modifiedAt', $customerPatch->customer);
        $this->assertObjectHasAttribute('address', $customerPatch->customer);
        $this->assertIsObject($customerPatch->customer->address);
        $this->assertObjectHasAttribute('addressLine1', $customerPatch->customer->address);
        $this->assertObjectHasAttribute('addressLine2', $customerPatch->customer->address);
        $this->assertObjectHasAttribute('city', $customerPatch->customer->address);
        $this->assertObjectHasAttribute('postalCode', $customerPatch->customer->address);
        $this->assertObjectHasAttribute('currency', $customerPatch->customer);
        $this->assertIsObject($customerPatch->customer->currency);
        $this->assertObjectHasAttribute('code', $customerPatch->customer->currency);
        $this->assertObjectHasAttribute('name', $customerPatch->customer->currency);
        $this->assertObjectHasAttribute('symbol', $customerPatch->customer->currency);
    }

    /**
     * Test patch customer with incorrect fields
     *
     * @return void
     */
    public function testPatchCustomerWithIncorrectFields()
    {
        $this->expectException(QueryError::class);
        $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
        $wave->patchCustomer([
            'customer' => ['uuid']
        ], [], [
            'input' => [
                'id' => getenv('WAVE_CUSTOMER_ID'),
                'email' => "new3@email.com"
            ]
        ]);
    }

    /**
     * Test patch customer with incorrect variables
     *
     * @return void
     */
    public function testPatchCustomerWithIncorrectVariables()
    {
        $this->expectException(QueryError::class);
        $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
        $wave->patchCustomer([], [], [
            'input' => [
                'id' => '1234567890',
                'email' => "new4@email.com"
            ]
        ]);
    }
}
