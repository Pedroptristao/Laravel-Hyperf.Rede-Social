<?php

declare(strict_types=1);

namespace App\Application\Post\Create;

use App\Application\Command;

class CreatePostCommand extends Command
{
    public function __construct(
        public readonly string $title,
        public readonly ?string $post_image_path,
        public readonly ?string $body,
        public readonly bool $published,
        public readonly int $user_id,
    )  {
    }
}
