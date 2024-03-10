<?php

declare(strict_types=1);

namespace App\Application\User\Create;

use App\Application\Command;

class CreateUserCommand extends Command
{
    public function __construct(
        public readonly string $first_name,
        public readonly string $last_name,
        public readonly string $email,
        public readonly string $password,
        public readonly ?string $profile_photo_path,
        public readonly string $theme,
    )  {
    }
}
