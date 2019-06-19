<?php

namespace App\Test\TestCase\Action;

use App\Test\TestCase\HttpTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \App\Action\HomePingAction
 */
class HomePingActionTest extends TestCase
{
    use HttpTestTrait;

    /**
     * Test create object.
     *
     * @return void
     *
     * @covers ::__invoke
     */
    public function testPing(): void
    {
        $request = $this->createServerRequest('POST', '/ping');
        $request = $this->withJson($request, ['username' => 'user', 'password' => 'user']);
        $response = $this->request($request);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertSame('{"username":"user","password":"user"}', $response->getBody()->__toString());
    }
}
