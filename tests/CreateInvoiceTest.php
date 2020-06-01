<?php

use PHPUnit\Framework\TestCase;
use Wave\Wave;
use GraphQL\Exception\QueryError;

/**
 * Test create invoice
 */
class CreateInvoiceTest extends TestCase
{
    /**
     * Test create invoice
     *
     * @return void
     */
    public function testCreateInvoice()
    {
        $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
        $invoiceCreate = $wave->createInvoice([], [], [
            'input' => [
                'businessId' => getenv('WAVE_BUSINESS_ID'),
                'customerId' => getenv('WAVE_CUSTOMER_ID'),
                'status' => "DRAFT",
                'items' => [
                    'productId' => getenv('WAVE_PRODUCT_ID'),
                ]
            ]
        ]);
        $this->assertIsObject($invoiceCreate);
        $this->assertEquals(1, $invoiceCreate->didSucceed);
    }

    /**
     * Test create invoice with correct fields
     *
     * @return void
     */
    public function testCreateInvoiceWithCorrectFields()
    {
        $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
        $invoiceCreate = $wave->createInvoice([], [], [
            'input' => [
                'businessId' => getenv('WAVE_BUSINESS_ID'),
                'customerId' => getenv('WAVE_CUSTOMER_ID'),
                'status' => "DRAFT",
                'items' => [
                    'productId' => getenv('WAVE_PRODUCT_ID'),
                    'description' => "test",
                    'quantity' => 1,
                    'unitPrice' => 14.99,
                    'taxes' => [
                        'salesTaxId' => getenv('WAVE_TAX_ID'),
                    ]
                ]
            ]
        ]);
        $this->assertIsObject($invoiceCreate);
        $this->assertEquals(1, $invoiceCreate->didSucceed);
    }

    /**
     * Test create invoice with incorrect fields
     *
     * @return void
     */
    public function testCreateInvoiceWithIncorrectFields()
    {
        $this->expectException(QueryError::class);
        $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
        $wave->createInvoice([], [], [
            'input' => [
                'businessId' => getenv('WAVE_BUSINESS_ID'),
                'customerId' => getenv('WAVE_CUSTOMER_ID'),
                'status' => "DRAFT",
                'items' => [
                    'productId' => getenv('WAVE_PRODUCT_ID'),
                    'name' => "test",
                    'qty' => 1,
                    'price' => 14.99,
                    'taxes' => [
                        'salesTaxId' => getenv('WAVE_TAX_ID'),
                    ]
                ]
            ]
        ]);
    }

    /**
     * Test create invoice with incorrect variables
     *
     * @return void
     */
    public function testCreateInvoiceWithIncorrectVariables()
    {
        $this->expectException(QueryError::class);
        $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
        $wave->createInvoice([], [], [
            'input' => [
                'businessId' => getenv('WAVE_BUSINESS_ID'),
                'customerId' => getenv('WAVE_CUSTOMER_ID'),
                'status' => "DRAFT",
                'items' => [
                    'productId' => '1234567890',
                    'name' => "test",
                    'qty' => 1,
                    'price' => 14.99,
                    'taxes' => [
                        'salesTaxId' => '1234567890',
                    ]
                ]
            ]
        ]);
    }
}
