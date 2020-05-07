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
                    'description' => "test",
                    'quantity' => 1,
                    'unitPrice' => 14.99,
                    'taxes' => [
                        'salesTaxId' => getenv('WAVE_TAX_ID'),
                    ]
                ]
            ]
        ]);
        print_r($invoiceCreate);
        $this->assertIsObject($invoiceCreate);
    }
}
