<?php

declare(strict_types=1);

namespace Tests\Unit\Application\User\Load;

use App\Application\User\Load\LoadUserQuery;
use App\Application\User\Load\LoadUserQueryHandler;
use App\Domain\User\User;
use App\Domain\User\Users;
use DateTimeImmutable;
use Illuminate\Database\Eloquent\Collection;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class LoadUserQueryHandlerTest extends TestCase
{
    private LoadUserQueryHandler $queryHandler;

    private Users&MockObject $users;

    protected function setUp(): void
    {
        parent::setUp();

        $this->users = $this->createMock(Users::class);
        $this->queryHandler = new LoadUserQueryHandler($this->users);
    }

    public function testLoadUserQueryHandler(): void
    {
        $user = new User(
            id: 0,
            first_name: 'John',
            last_name: 'Doe',
            email: 'john@example.com',
            password: '',
            emailVerifiedAt: null,
            profile_photo_path: '',
            theme: '',
            createdAt: new DateTimeImmutable('2023-09-09 00:15:00'),
            updatedAt: new DateTimeImmutable('2023-09-09 00:15:00'),
            deletedAt: null,
        );

        $this->users
            ->expects($this->once())
            ->method('get')
            ->with(1)
            ->willReturn(new Collection([$user]));

        $query = new LoadUserQuery(1);
        $loadedUser = $this->queryHandler->handle($query);

        $this->assertEquals($user, $loadedUser->first());
    }
}
