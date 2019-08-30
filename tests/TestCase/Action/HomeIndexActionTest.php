<?php

namespace App\Test\TestCase\Action;

use App\Test\TestCase\HttpTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * Test.
 *
 * @coversDefaultClass \App\Action\HomeIndexAction
 */
class HomeIndexActionTest extends TestCase
{
    use HttpTestTrait;

    /**
     * Verify a non-authenticated user gets redirected to your login page.
     *
     * @return void
     */
    public function testIndexAction(): void
    {
        $request = $this->createRequest('GET', '/');
        $response = $this->request($request);

        // Assert redirect
        static::assertSame(302, $response->getStatusCode());
        static::assertSame('/users/login', $response->getHeaderLine('Location'));
    }

    /**
     * Test invalid link.
     *
     * @return void
     */
    public function testPageNotFound(): void
    {
        $request = $this->createRequest('GET', '/not-existing-page');
        $response = $this->request($request);

        static::assertContains('<h1>Page Not Found</h1>', (string)$response->getBody());
        static::assertSame(404, $response->getStatusCode());
    }
}
