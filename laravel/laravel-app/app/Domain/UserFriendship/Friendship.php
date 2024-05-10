<?php

declare(strict_types=1);

namespace App\Domain\UserFriendship;

use DateTimeImmutable;

class Friendship
{
    public function __construct(
        public ?int $id,
        public int $user_id,
        public int $friend_id,
        public DateTimeImmutable $friends_since,
    ) {
    }

    public static function create(
        ?int $id,
        int $user_id,
        int $friend_id,
        DateTimeImmutable $friends_since
    ): self {
        return new self(
            id: $id,
            user_id: $user_id,
            friend_id: $friend_id,
            friends_since: $friends_since
        );
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'friend_id' => $this->friend_id,
            'friends_since' => $this->friends_since->format('Y-m-d H:i:s'),
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            user_id: $data['user_id'],
            friend_id: $data['friend_id'],
            friends_since: new DateTimeImmutable($data['friends_since'])
        );
    }
}
