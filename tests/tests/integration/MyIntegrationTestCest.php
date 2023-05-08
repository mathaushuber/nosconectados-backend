<?php

namespace Tests\Integration;

use Tests\Support\IntegrationTester;

class MyIntegrationTestCest
{
    public function _before(IntegrationTester $I)
    {
        // Executed before each test
    }

    public function _after(IntegrationTester $I)
    {
        // Executed after each test
    }

    public function testDatabaseNullValues(IntegrationTester $I)
    {
        echo("\n");
        var_dump('this database does not accept null values for password, document, firstName, lastName, phone and email.');
    }

    public function testAboutPage(IntegrationTester $I)
    {
        var_dump('About', 'h1');
        var_dump('This is the about page.', 'p');
    }
}
