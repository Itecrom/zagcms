<?php

namespace App\Policies;

use App\Models\Member;
use App\Models\User;

class MemberPolicy
{
    public function before(User $user, string $ability)
    {
        // Super admin can do everything
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    public function viewAny(User $user): bool
    {
        // all authenticated roles can view their scoped lists
        return in_array($user->role, ['super_admin','homecell_pastor','ministry_leader']);
    }

    public function view(User $user, Member $member): bool
    {
        if ($user->isHomecellPastor()) {
            return $user->homecell_id && $member->homecell_id === $user->homecell_id;
        }
        if ($user->isMinistryLeader()) {
            return $user->ministry_id && $member->ministry_id === $user->ministry_id;
        }
        return false;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['super_admin','homecell_pastor','ministry_leader']);
    }

    public function update(User $user, Member $member): bool
    {
        if ($user->isHomecellPastor()) {
            return $user->homecell_id && $member->homecell_id === $user->homecell_id;
        }
        if ($user->isMinistryLeader()) {
            return $user->ministry_id && $member->ministry_id === $user->ministry_id;
        }
        return false;
    }

    public function delete(User $user, Member $member): bool
    {
        // same rule as update
        return $this->update($user, $member);
    }
}
