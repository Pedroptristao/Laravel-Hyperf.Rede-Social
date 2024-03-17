<?php

declare(strict_types=1);

namespace Unit\Presenter\Http\Payment;

use App\Application\User\Load\LoadUserQueryHandler;
use App\Domain\User\User;
use App\Domain\User\UserNotFound;
use App\Presenter\Http\User\Load\LoadUserController;
use DateTimeImmutable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Hash;
use Mockery;
use Mockery\MockInterface;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class LoadUserControllerTest extends TestCase
{
    private LoadUserQueryHandler&MockInterface $handler;

    private LoadUserController $controller;

    protected function setUp(): void
    {
        parent::setUp();

        Facade::setFacadeApplication($this->app);

        $this->handler = $this->mock(LoadUserQueryHandler::class);
        $this->controller = app(LoadUserController::class);
    }

    public function testGivenInvalidIdQueryItShouldReturnHttpNotFound(): void
    {
        $this->handler
            ->shouldReceive('handle')
            ->once()
            ->andThrow(new UserNotFound(1));

        $response = $this->controller->__invoke(1);

        $expectedJson = json_encode([
            'error' => 'User Not Found',
            'details' => ['id' => 1],
        ]);

        $this->assertEquals($expectedJson, $response->getContent());
        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    public function testGivenQueryItShouldReturnFound(): void
    {
        $hashedPassword = Hash::make('password');

        $user = new User(
            id: 6,
            first_name: 'John',
            last_name: 'Doe',
            email: 'john@example.com',
            password: $hashedPassword,
            emailVerifiedAt: null,
            profile_photo_path: '',
            theme: 'light',
            createdAt: new DateTimeImmutable('2023-09-09 00:15:00'),
            updatedAt: new DateTimeImmutable('2023-09-09 00:15:00'),
            deletedAt: null,
        );

        $this->handler
            ->shouldReceive('handle')
            ->once()
            ->andReturn($user);

        $response = $this->controller->__invoke(6);

        $expectedJson = json_encode([
            'id' => 6,
            'type' => 'user',
            'attributes' => [
                'id' => 6,
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'email_verified_at' => null, // Adjust if necessary
                'profile_photo_path' => null, // Adjust if necessary
                'theme' => 'light',
                'created_at' => '2023-09-09T00:15:00.000000Z', // Adjust timezone if necessary
                'updated_at' => '2023-09-09T00:15:00.000000Z', // Adjust timezone if necessary
                'deleted_at' => null, // Adjust if necessary
            ],
            'relationships' => [], // Adjust if necessary
            'links' => [
                'self' => 'http://laravel-app/api/v1/user/6',
                'parent' => 'http://laravel-app/api/v1/user',
            ],
        ]);

        $this->assertEquals($expectedJson, $response->getContent());
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }
}
