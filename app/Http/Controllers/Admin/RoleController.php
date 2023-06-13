<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleStoreRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Roles/Index', [
            'roles' => Role::all()
        ]);
    }

    public function store(RoleStoreRequest $request)
    {
        Role::query()->create($request->validated());

        return Redirect::route('roles.index')->with('message');
    }

    public function show(Role $role): Response
    {
        return Inertia::render('Roles/Show', [
            'role' => $role
        ]);
    }

    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();

        return Redirect::route('roles.index');
    }
}
