<?php

namespace App\Actions\Fortify;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RedirectAfterLogin
{
    /**
     * Handle the redirect after login.
     */
    public function __invoke(Request $request): RedirectResponse
    {
        // Check if user has a specific role and redirect accordingly
        if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('super-admin')) {
            return redirect()->route('admin-dashboard.users.index');
        }

        // Default redirect to dashboard
        return redirect()->route('dashboard.home');
    }
}
