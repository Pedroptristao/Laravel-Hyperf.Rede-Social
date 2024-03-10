<?php

declare(strict_types=1);

namespace App\Domain\User;

use DateTimeImmutable;
use Hash;

class User
{
    public function __construct(
        public ?int $id,
        public string $first_name,
        public string $last_name,
        public string $email,
        public ?string $password,
        public ?DateTimeImmutable $emailVerifiedAt,
        public ?string $profile_photo_path,
        public string $theme,
        public ?DateTimeImmutable $createdAt,
        public ?DateTimeImmutable $updatedAt,
        public ?DateTimeImmutable $deletedAt,
    ) {
    }

    public static function create(
        ?int $id,
        string $first_name,
        string $last_name,
        string $email,
        string $password,
        ?string $profile_photo_path,
        string $theme,
    ): self {
        return new self(
            id: $id,
            first_name: $first_name,
            last_name: $last_name,
            email: $email,
            password: Hash::make($password),
            emailVerifiedAt: null,
            profile_photo_path: $profile_photo_path,
            theme: $theme,
            createdAt: new DateTimeImmutable('2023-09-09 00:15:00'),
            updatedAt: new DateTimeImmutable('2023-09-09 00:15:00'),
            deletedAt: null
        );
    }

    public function toArray(): array
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => $this->password,
            'profile_photo_path' => $this->profile_photo_path,
            'theme' => $this->theme,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            first_name: $data['first_name'],
            last_name: $data['last_name'],
            email: $data['email'],
            password: $data['password'] ?? null,
            emailVerifiedAt: null,
            profile_photo_path: $data['profile_photo_path'] ?? null,
            theme: $data['theme'] ?? 'light',
            createdAt: null,
            updatedAt: null,
            deletedAt: null
        );
    }
}
