<?php

namespace App\Helpers;

use App\Models\User;

class AdminHelper
{
    /**
     * Check if user is admin
     */
    public static function isAdmin(User $user): bool
    {
        return $user->role === 'admin';
    }
    
    /**
     * Check if current authenticated user is admin
     */
    public static function isCurrentUserAdmin(): bool
    {
        if (!\Illuminate\Support\Facades\Auth::check()) {
            return false;
        }
        
        $user = \Illuminate\Support\Facades\Auth::user();
        return $user->role === 'admin';
    }
    
    /**
     * Check if user is super admin (first admin or admin with special privileges)
     */
    public static function isSuperAdmin(User $user): bool
    {
        // Check if this is the first admin (lowest ID with admin role)
        $firstAdmin = User::where('role', 'admin')->orderBy('id', 'asc')->first();
        
        if ($firstAdmin && $firstAdmin->id === $user->id) {
            return true;
        }
        
        // You can add more conditions here for super admin privileges
        // For example, check for a specific field or permission
        return false;
    }
    
    /**
     * Check if current authenticated user is super admin
     */
    public static function isCurrentUserSuperAdmin(): bool
    {
        if (!\Illuminate\Support\Facades\Auth::check()) {
            return false;
        }
        
        $user = \Illuminate\Support\Facades\Auth::user();
        return self::isSuperAdmin($user);
    }
}
