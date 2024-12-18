<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;

class UserDashboardService
{
    /**
     * Get the user's dashboard data.
     *
     * @param User $user
     * @return array
     */
    public static function getDashboardRoute()
    {
        $user = auth()->user();

        $role = $user->id == 1 ? 'admin' : 'customer';
        self::createUserRole($role);
        return [];
    }

    public static function createUserRole($roleName)
    {
        if (! Role::where('title', $roleName)->exists()) {
            Role::create([
                'title' => $roleName,
            ]);
        }
        return $roleName;
    }
}
