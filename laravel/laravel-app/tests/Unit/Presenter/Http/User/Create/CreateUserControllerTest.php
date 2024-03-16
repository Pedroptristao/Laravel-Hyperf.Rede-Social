<?php

declare(strict_types=1);

namespace Unit\Presenter\Http\Payment;

use App\Application\User\Create\CreateUserCommand;
use App\Application\User\Create\CreateUserCommandHandler;
use App\Presenter\Http\User\Create\CreateUserController;
use App\Presenter\Http\User\Create\CreateUserRequest;
use Mockery;
use Mockery\MockInterface;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CreateUserControllerTest extends TestCase
{
    private CreateUserCommandHandler&MockInterface $handler;

    private CreateUserController $controller;

    private CreateUserRequest&MockInterface $request;

    protected function setUp(): void
    {
        parent::setUp();
        $this->handler = $this->mock(CreateUserCommandHandler::class);
        $this->request = $this->mock(CreateUserRequest::class);
        $this->controller = app(CreateUserController::class);
    }

    public function testGivenCommandItShouldReturnHttpCreated(): void
    {
        $command = new CreateUserCommand(
            first_name: 'name',
            last_name: 'test',
            email: 'email',
            password: 'password',
            profile_photo_path: '',
            theme: ''              
        );

        $this->request
            ->shouldReceive('toCommand')
            ->andReturn($command);

        $this->handler
            ->shouldReceive('handle')
            ->with($command);

        $response = $this->controller->__invoke($this->request);

        $this->assertEquals('{"first_name":"name","last_name":"test","email":"email","password":"password","profile_photo_path":"","theme":""}', $response->getContent());
        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
    }


}
