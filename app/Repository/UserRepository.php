<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    public function __construct(
        protected User $user = new User()
    ) {
    }

    public function getUser(mixed $userId): ?User
    {
        return $this->user->findOrFail($userId);
    }

    public function getUserByUsername(string $username): ?User
    {
        return $this->user->where('username', $username)->first();
    }

    public function getUsers(): Collection
    {
        return $this->user->all();
    }
}
