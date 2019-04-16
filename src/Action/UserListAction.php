<?php

namespace App\Action;

use App\Domain\User\UserList;
use App\Http\JsonResponder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action.
 */
class UserListAction implements ActionInterface
{
    /**
     * @var JsonResponder
     */
    private $responder;

    /**
     * @var UserList
     */
    protected $service;

    /**
     * Constructor.
     *
     * @param JsonResponder $responder
     * @param UserList $service
     */
    public function __construct(JsonResponder $responder, UserList $service)
    {
        $this->responder = $responder;
        $this->service = $service;
    }

    /**
     * Action.
     *
     * @param ServerRequestInterface $request the request
     *
     * @return ResponseInterface the response
     */
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $params = (array)$request->getParsedBody();
        $result = $this->service->listAllUsers($params);

        return $this->responder->encode($result);
    }
}
