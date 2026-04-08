<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    /**
     * Determine whether the user can view any models.
     * Semua user yang sudah login boleh melihat daftar produk.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     * Semua user yang sudah login boleh melihat detail produk.
     */
    public function view(User $user, Product $product): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     * Semua user yang sudah login boleh membuat produk.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     * Tidak boleh edit lintas role.
     * Admin tidak boleh edit data milik user, dan user tidak boleh edit data milik admin.
     * Untuk update, pengguna hanya boleh mengubah data miliknya sendiri.
     */
    public function update(User $user, Product $product): bool
    {
        return $user->id === $product->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     * Admin bisa menghapus produk siapa saja.
     * User biasa hanya bisa menghapus produk miliknya sendiri.
     */
    public function delete(User $user, Product $product): bool
    {
        // Admin bisa delete produk siapa saja
        if ($user->role === 'admin') {
            return true;
        }

        // User biasa hanya bisa delete produk miliknya sendiri
        return $user->id === $product->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Product $product): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Product $product): bool
    {
        return $user->role === 'admin';
    }
}
