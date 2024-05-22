<?php

declare(strict_types=1);

namespace App\Application\User\Delete;

use App\Application\Query;
use App\Application\QueryHandler;
use App\Domain\User\User;
use App\Domain\User\Users;
class DeleteUserQueryHandler implements QueryHandler
{
    public function __construct(
        private readonly Users $users
    ) {
    }

    /**
     * @param DeleteUserQuery $command
     */
    public function handle(Query $command, string | null $perPage): array
    {   
        return $this->users->delete($command->id);
    }
}
