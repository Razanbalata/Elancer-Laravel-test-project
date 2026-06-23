<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{


   /// the policy CRUD: 
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     // if(! Gate::allows('users.view')){
    //     //     abort(403);
    //     // };

    //     $user = Auth::user();
    //     abort_if(!$user->can('viewAny', User::class), 403);


    //     echo 'Admin Dashboard';
    // }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     abort_if(!Auth::user()->can('create', User::class), 403);
    //     return __METHOD__;
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     abort_if(!Auth::user()->can('create', User::class), 403);
    //     return __METHOD__;
    // }

    /**
     * Display the specified resource.
     */
    // public function show(User $user)
    // {
    //     abort_if(!Auth::user()->can('view', $user), 403);
    //     return __METHOD__;
    // }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(User $user)
    // {
    //     abort_if(!Auth::user()->can('update', $user), 403);
    //     return __METHOD__;
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request,User $user)
    // {
    //     abort_if(!Auth::user()->can('update', $user), 403);
    //     return __METHOD__;
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(User $user)
    // {
    //      abort_if(!Auth::user()->can('delete', $user), 403);
    //     return __METHOD__;
    // }


    public function index()
    {
        $users = User::with('roles')->paginate(10);

        return view('admin-dashboard.users.index', compact('users'));
    }



    public function create()
    {
        $roles = Role::all();

        return view('admin-dashboard.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'roles' => 'array'
        ]);
        $user = User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        $user->roles()->sync($validated['roles'] ?? []);
        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        $user->load('roles');

        return view('admin-dashboard.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'roles' => 'array'
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        $user->roles()->sync($validated['roles'] ?? []);

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->roles()->detach();

        $user->delete();

        return redirect()->route('admin-dashboard.users.index')
            ->with('success', 'User deleted successfully');
    }
}
