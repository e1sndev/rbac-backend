<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', Permission::class);

        $result = Permission::latest()->get();

        return response()->json($result);
    }
}
