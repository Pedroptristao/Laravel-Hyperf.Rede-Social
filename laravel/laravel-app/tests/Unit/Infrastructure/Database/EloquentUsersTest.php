<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Database;

use App\Domain\User\User;
use App\Domain\User\UserNotFound;
use App\Infrastructure\Database\EloquentUsers;
use App\Infrastructure\Database\Models\UserModel;
use DateTimeImmutable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Mockery\MockInterface;
use Tests\TestCase as TestsTestCase;

class EloquentUsersTest extends TestsTestCase
{
    private MockInterface $model;
    private EloquentUsers $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->model = $this->mock(UserModel::class);
        $this->repository = app(EloquentUsers::class);
    }

    public function testGivenUserEntityItShouldInsertByTheModel(): void
    {
        $user = new User(
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
        );
        $this->model
            ->shouldReceive('create')
            ->once()
            ->with([
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'password' => 'password',
                'profile_photo_path' => '',
                'theme' => '',
            ]);

        $this->repository->create($user);
    }

    public function testGivenUserEntityItShouldBeReturnByTheModel(): void
    {
        $this->model
            ->shouldReceive('findOrFail')
            ->once()
            ->andReturn(new UserModel([
                'id' => 1,
                'name' => '',
                'email' => '',
                'password' => '',
                'createdAt' => new DateTimeImmutable('2023-09-09 00:15:00')
            ]));

        $this->repository->get(1);
    }

    public function testGivenWrongUserEntityItShouldReturnAnExceptionByTheModel(): void
    {
        $this->model
            ->shouldReceive('findOrFail')
            ->once()
            ->andThrow(ModelNotFoundException::class);

        $this->expectException(UserNotFound::class);

        $this->repository->get(1);
    }
}
