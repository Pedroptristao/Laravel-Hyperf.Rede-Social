<?php

declare(strict_types=1);

namespace App\Application\Post\Create;

use App\Application\Command;
use App\Application\CommandHandler;
use App\Domain\Post\Post;
use App\Domain\Post\Posts;

class CreatePostCommandHandler implements CommandHandler
{
    public function __construct(
        private readonly Posts $posts
    ) {
    }

    public function handle(Command $command)
    {
        $post = Post::create(null, ...$command->getProperties());
        
        $this->posts->create($post);
    }
}
