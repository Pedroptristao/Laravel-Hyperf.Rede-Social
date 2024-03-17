<?php

declare(strict_types=1);

namespace App\Domain\Post;

use DateTimeImmutable;
use Illuminate\Support\Facades\Hash;

class Post
{
    public function __construct(
        public ?int $id,
        public string $title,
        public ?string $post_image_path,
        public ?string $body,
        public bool $published,
        public int $user_id,
        public ?DateTimeImmutable $createdAt,
        public ?DateTimeImmutable $updatedAt,
        public ?DateTimeImmutable $deletedAt,
        public ?array $relationships,
        public ?string $route_self,
        public ?string $route_parent,
    ) {
    }

    public static function create(
        ?int $id,
        string $title,
        ?string $post_image_path,
        ?string $body,
        bool $published,
        int $user_id,
    ): self {
        return new self(
            id: $id,
            title: $title,
            post_image_path: $post_image_path,
            body: $body,
            published: $published,
            user_id: $user_id,
            createdAt: new DateTimeImmutable('2023-09-09 00:15:00'),
            updatedAt: new DateTimeImmutable('2023-09-09 00:15:00'),
            deletedAt: null,
            relationships: null,
            route_self: null,
            route_parent: null
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'post_image_path' => $this->post_image_path,
            'body' => $this->body,
            'published' => $this->published,
            'user_id' => $this->user_id,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            title: $data['title'],
            post_image_path: $data['post_image_path'],
            body: $data['body'] ?? null,
            published: $data['published'] ?? null,
            user_id: $data['user_id'] ?? 'light',
            createdAt: null,
            updatedAt: null,
            deletedAt: null,
            relationships: $data['user'],
            route_self: 'api:v1:posts:show',
            route_parent: 'api:v1:posts:index'

        );
    }
}
