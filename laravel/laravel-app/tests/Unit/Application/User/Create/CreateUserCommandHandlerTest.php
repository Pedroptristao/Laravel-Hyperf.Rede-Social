<?php

declare(strict_types=1);

namespace Tests\Unit\Application\User\Create;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Facade;
use App\Application\User\Create\CreateUserCommand;
use App\Application\User\Create\CreateUserCommandHandler;
use App\Domain\User\User;
use App\Domain\User\Users;
use DateTimeImmutable;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class CreateUserCommandHandlerTest extends TestCase
{
    private CreateUserCommandHandler $commandHandler;

    private Users&MockObject $users;

    public function setUp(): void
    {
        parent::setUp();

        $this->users = $this->createMock(Users::class);
        $this->commandHandler = new CreateUserCommandHandler($this->users);
    }

    public function testCreateUserCommandHandler(): void
    {

        $command = new CreateUserCommand(
            first_name: 'John',
            last_name: 'Doe',
            email: 'john@example.com',
            password: 'password',
            profile_photo_path: '',
            theme: ''
        );

        $this->users
            ->expects($this->once())
            ->method('create')
            ->with(
                new User(
                    id: 0,
                    first_name: 'John',
                    last_name: 'Doe',
                    email: 'john@example.com',
                    password: 'password',
                    emailVerifiedAt: null,
                    profile_photo_path: '',
                    theme: '',
                    createdAt: new DateTimeImmutable('2023-09-09 00:15:00'),
                    updatedAt: new DateTimeImmutable('2023-09-09 00:15:00'),
                    deletedAt: null,
                )
            );

        $this->commandHandler->handle($command);
    }
}
