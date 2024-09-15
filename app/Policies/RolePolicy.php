<?php

namespace App\Policies;

use App\Models\User;

class RolePolicy
{
    public function Admin(User $user): bool
    {
        return $user->role === 'administrator';
    }
    public function Agent(User $user): bool
    {
        return $user->role === 'agent';
    }

    public function AdminAndAgent(User $user): bool
    {
        return in_array($user->role, ['administrator', 'agent']);
    }
}
