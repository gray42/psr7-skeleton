<?php

namespace App\Test\TestCase;

use PHPUnit\Framework\TestCase;

/**
 * Unit test.
 */
class UnitTestCase extends TestCase
{
    use AppTestTrait;

    /** {@inheritdoc} */
    protected function setUp()
    {
        $this->bootApp();
    }

    /** {@inheritdoc} */
    protected function tearDown()
    {
        $this->shutdownApp();
    }
}
