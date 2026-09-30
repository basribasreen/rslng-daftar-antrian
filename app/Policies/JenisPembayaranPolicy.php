<?php

namespace App\Policies;

use App\Models\JenisPembayaran;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JenisPembayaranPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('pembayarans.view-any');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, JenisPembayaran $jenisPembayaran): bool
    {
        return $user->can('pembayarans.view-any');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('pembayarans.create-any');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, JenisPembayaran $jenisPembayaran): bool
    {
        return $user->can('pembayarans.update-any');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, JenisPembayaran $jenisPembayaran): bool
    {
        return $user->can('pembayarans.delete-any');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, JenisPembayaran $jenisPembayaran): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, JenisPembayaran $jenisPembayaran): bool
    {
        return false;
    }
}
